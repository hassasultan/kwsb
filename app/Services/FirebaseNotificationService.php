<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\WebPushConfig;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Exception\FirebaseException;
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
    public function sendNotification($deviceTokens, string $title, string $body, array $data = [], string $type = 'general', $recipientId = null, $recipientType = null, $senderId = null,$platform = 'android' )
    {
        $results = [];
        $successCount = 0;
        $failureCount = 0;

        try {
            $notification = Notification::create($title, $body);

        // Ensure all data values are strings
        $stringData = [];
        foreach ($data as $key => $value) {
            $stringData[$key] = is_scalar($value) || $value === null
                ? (string) $value
                : json_encode($value);
        }

        $message = CloudMessage::new()->withData($stringData);

        // Platform-specific configs
        if ($platform === 'android') {
            $message = $message->withAndroidConfig(AndroidConfig::fromArray([
                'priority' => 'high',
                'notification' => [
                    'sound' => 'default',
                ],
            ]));
        } elseif ($platform === 'ios') {
            $message = $message->withApnsConfig(ApnsConfig::fromArray([
                'headers' => ['apns-priority' => '10'],
                'payload' => [
                    'aps' => [
                        'sound' => 'default',
                        'alert' => ['title' => $title, 'body' => $body],
                    ],
                ],
            ]));
        } elseif ($platform === 'web') {
            $message = $message->withWebPushConfig(WebPushConfig::fromArray([
                'headers' => ['Urgency' => 'high'],
                'notification' => [
                    'title' => $title,
                    'body' => $body,
                    'icon' => '/firebase-logo.png',
                ],
            ]));
        }

        // Attach notification if not data-only
        $includeNotification = empty($stringData['_data_only'])
            || $stringData['_data_only'] === 'false'
            || $stringData['_data_only'] === '0';

        if ($includeNotification) {
            $message = $message->withNotification($notification);
        }

        // Handle single or multiple tokens
        $tokens = is_array($deviceTokens) ? $deviceTokens : [$deviceTokens];

        foreach ($tokens as $token) {
            $result = $this->sendToToken($message, $token, $title, $body, $data, $type, $recipientId, $recipientType, $senderId);
            $results[] = $result;
            $result['success'] ? $successCount++ : $failureCount++;
        }

        Log::info("Firebase notification sent", [
            'success_count' => $successCount,
            'failure_count' => $failureCount,
            'total' => count($results)
        ]);

        } catch (MessagingException $e) {
            Log::error('Firebase notification failed (MessagingException): ' . $e->getMessage(), [
                'errors' => method_exists($e, 'errors') ? $e->errors() : null,
            ]);
            throw $e;
        } catch (FirebaseException $e) {
            Log::error('Firebase notification failed (FirebaseException): ' . $e->getMessage());
            throw $e;
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
        } catch (MessagingException $e) {
            Log::error("Failed to send notification to token {$token} (MessagingException): " . $e->getMessage(), [
                'errors' => method_exists($e, 'errors') ? $e->errors() : null,
            ]);

            // Log failed notification
            $this->logNotification($title, $body, $data, $type, $recipientId, $recipientType, $senderId, 'failed', $e->getMessage());

            return [
                'success' => false,
                'token' => $token,
                'message_id' => null,
                'error' => $e->getMessage()
            ];
        } catch (FirebaseException $e) {
            Log::error("Failed to send notification to token {$token} (FirebaseException): " . $e->getMessage());

            $this->logNotification($title, $body, $data, $type, $recipientId, $recipientType, $senderId, 'failed', $e->getMessage());

            return [
                'success' => false,
                'token' => $token,
                'message_id' => null,
                'error' => $e->getMessage()
            ];
        } catch (Exception $e) {
            Log::error("Failed to send notification to token {$token}: " . $e->getMessage());

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
