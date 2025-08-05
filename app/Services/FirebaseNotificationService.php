<?php

namespace App\Services;

// Install the Firebase PHP SDK with:
// composer require kreait/firebase-php
//
// Place your Firebase service account JSON in storage/app/firebase/firebase_credentials.json
// and update the path below as needed.

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseNotificationService
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(storage_path('app/firebase/firebase_credentials.json'));
        $this->messaging = $factory->createMessaging();
    }

    /**
     * Send a push notification to one or more device tokens.
     *
     * @param array|string $deviceTokens
     * @param string $title
     * @param string $body
     * @param array $data
     * @return void
     */
    public function sendNotification($deviceTokens, string $title, string $body, array $data = [])
    {
        $notification = Notification::create($title, $body);
        $message = CloudMessage::new()->withNotification($notification)->withData($data);

        if (is_array($deviceTokens)) {
            foreach ($deviceTokens as $token) {
                $this->messaging->send($message->withChangedTarget('token', $token));
            }
        } else {
            $this->messaging->send($message->withChangedTarget('token', $deviceTokens));
        }
    }
}
