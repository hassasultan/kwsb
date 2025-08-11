<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\WebPushConfig;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\ApnsConfig;
use App\Models\Notification as NotificationModel;
use Illuminate\Support\Facades\Log;
use Exception;

class FirebaseNotificationService
{
    protected $messaging;

    public function __construct()
    {
        try {
            $factory = new Factory();

            // Check if using environment variables or service account file
            if (config('firebase.use_env', false) && env('FIREBASE_PROJECT_ID')) {
                // Use environment variables
                $factory = $factory->withServiceAccount([
                    'type' => 'service_account',
                    'project_id' => env('FIREBASE_PROJECT_ID'),
                    'private_key_id' => env('FIREBASE_PRIVATE_KEY_ID'),
                    'private_key' => env('FIREBASE_PRIVATE_KEY'),
                    'client_email' => env('FIREBASE_CLIENT_EMAIL'),
                    'client_id' => env('FIREBASE_CLIENT_ID'),
                    'auth_uri' => env('FIREBASE_AUTH_URI', 'https://accounts.google.com/o/oauth2/auth'),
                    'token_uri' => env('FIREBASE_TOKEN_URI', 'https://oauth2.googleapis.com/token'),
                    'auth_provider_x509_cert_url' => env('FIREBASE_AUTH_PROVIDER_X509_CERT_URL', 'https://www.googleapis.com/oauth2/v1/certs'),
                    'client_x509_cert_url' => env('FIREBASE_CLIENT_X509_CERT_URL'),
                ]);
            } else {
                // Use service account file
                $credentialsPath = storage_path('app/firebase/firebase_credentials.json');

                if (!file_exists($credentialsPath)) {
                    throw new Exception('Firebase credentials file not found at: ' . $credentialsPath);
                }

                $factory = $factory->withServiceAccount($credentialsPath);
            }

            $this->messaging = $factory->createMessaging();

        } catch (Exception $e) {
            Log::error('Firebase initialization failed: ' . $e->getMessage());
            throw new Exception('Firebase service not available: ' . $e->getMessage());
        }
    }

    /**
     * Send a push notification to one or more device tokens.
     *
     * @param array|string $deviceTokens
     * @param string $title
     * @param string $body
     * @param array $data
     * @param string $type
     * @param int|null $recipientId
     * @param string|null $recipientType
     * @param int|null $senderId
     * @return array
     */
    public function sendNotification($deviceTokens, string $title, string $body, array $data = [], string $type = 'general', $recipientId = null, $recipientType = null, $senderId = null)
    {
        $results = [];
        $successCount = 0;
        $failureCount = 0;

        try {
            $notification = Notification::create($title, $body);

            // Create message with different platform configurations
            $message = CloudMessage::new()
                ->withNotification($notification)
                ->withData($data)
                ->withWebPushConfig(WebPushConfig::fromArray([
                    'headers' => [
                        'Urgency' => 'high',
                    ],
                ]))
                ->withAndroidConfig(AndroidConfig::fromArray([
                    'priority' => 'high',
                    'notification' => [
                        'sound' => 'default',
                        'priority' => 'high',
                    ],
                ]))
                ->withApnsConfig(ApnsConfig::fromArray([
                    'headers' => [
                        'apns-priority' => '10',
                    ],
                    'payload' => [
                        'aps' => [
                            'sound' => 'default',
                            'badge' => 1,
                        ],
                    ],
                ]));

            if (is_array($deviceTokens)) {
                foreach ($deviceTokens as $token) {
                    $result = $this->sendToToken($message, $token, $title, $body, $data, $type, $recipientId, $recipientType, $senderId);
                    $results[] = $result;
                    if ($result['success']) {
                        $successCount++;
                    } else {
                        $failureCount++;
                    }
                }
            } else {
                $result = $this->sendToToken($message, $deviceTokens, $title, $body, $data, $type, $recipientId, $recipientType, $senderId);
                $results[] = $result;
                if ($result['success']) {
                    $successCount++;
                } else {
                    $failureCount++;
                }
            }

            Log::info("Firebase notification sent", [
                'success_count' => $successCount,
                'failure_count' => $failureCount,
                'total' => count($results)
            ]);

        } catch (Exception $e) {
            Log::error('Firebase notification failed: ' . $e->getMessage());
            throw $e;
        }

        return [
            'success_count' => $successCount,
            'failure_count' => $failureCount,
            'results' => $results
        ];
    }

    /**
     * Send notification to a specific token
     */
    private function sendToToken($message, $token, $title, $body, $data, $type, $recipientId, $recipientType, $senderId)
    {
        try {
            $result = $this->messaging->send($message->withChangedTarget('token', $token));

            // Log successful notification
            $this->logNotification($title, $body, $data, $type, $recipientId, $recipientType, $senderId, 'delivered');

            return [
                'success' => true,
                'token' => $token,
                'message_id' => $result,
                'error' => null
            ];
        } catch (Exception $e) {
            Log::error("Failed to send notification to token {$token}: " . $e->getMessage());

            // Log failed notification
            $this->logNotification($title, $body, $data, $type, $recipientId, $recipientType, $senderId, 'failed', $e->getMessage());

            return [
                'success' => false,
                'token' => $token,
                'message_id' => null,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Log notification to database
     */
    private function logNotification($title, $body, $data, $type, $recipientId, $recipientType, $senderId, $status, $errorMessage = null)
    {
        try {
            NotificationModel::create([
                'title' => $title,
                'body' => $body,
                'data' => $data,
                'type' => $type,
                'status' => $status,
                'recipient_id' => $recipientId,
                'recipient_type' => $recipientType,
                'sender_id' => $senderId,
                'sent_at' => now(),
                'delivered_at' => $status === 'delivered' ? now() : null,
                'error_message' => $errorMessage,
            ]);
        } catch (Exception $e) {
            Log::error('Failed to log notification: ' . $e->getMessage());
        }
    }

    /**
     * Send notification to all agents
     */
    public function sendToAllAgents($title, $body, $data = [], $senderId = null)
    {
        $agents = \App\Models\MobileAgent::with('user')
            ->whereHas('user', function($query) {
                $query->whereNotNull('device_token');
            })
            ->get();

        $tokens = $agents->pluck('user.device_token')->filter()->toArray();

        if (empty($tokens)) {
            return ['success_count' => 0, 'failure_count' => 0, 'results' => []];
        }

        return $this->sendNotification($tokens, $title, $body, $data, 'general', null, 'all', $senderId);
    }

    /**
     * Send notification to agents by town
     */
    public function sendToAgentsByTown($townId, $title, $body, $data = [], $senderId = null)
    {
        $agents = \App\Models\MobileAgent::with('user')
            ->where('town_id', $townId)
            ->whereHas('user', function($query) {
                $query->whereNotNull('device_token');
            })
            ->get();

        $tokens = $agents->pluck('user.device_token')->filter()->toArray();

        if (empty($tokens)) {
            return ['success_count' => 0, 'failure_count' => 0, 'results' => []];
        }

        return $this->sendNotification($tokens, $title, $body, $data, 'general', $townId, 'town', $senderId);
    }

    /**
     * Send notification to agents by type
     */
    public function sendToAgentsByType($typeId, $title, $body, $data = [], $senderId = null)
    {
        $agents = \App\Models\MobileAgent::with('user')
            ->where('type_id', $typeId)
            ->whereHas('user', function($query) {
                $query->whereNotNull('device_token');
            })
            ->get();

        $tokens = $agents->pluck('user.device_token')->filter()->toArray();

        if (empty($tokens)) {
            return ['success_count' => 0, 'failure_count' => 0, 'results' => []];
        }

        return $this->sendNotification($tokens, $title, $body, $data, 'general', $typeId, 'type', $senderId);
    }
}
