<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Firebase Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure Firebase settings for your application.
    |
    */

    // Use environment variables instead of service account file
    'use_env' => env('FIREBASE_USE_ENV', false),

    // Firebase project configuration
    'project_id' => env('FIREBASE_PROJECT_ID'),

    // Service account credentials
    'credentials' => [
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
    ],

    // Service account file path
    'credentials_file' => storage_path('app/firebase/firebase_credentials.json'),

    // Firebase messaging settings
    'messaging' => [
        'default_ttl' => env('FIREBASE_DEFAULT_TTL', 3600),
        'priority' => env('FIREBASE_PRIORITY', 'high'),
        'sound' => env('FIREBASE_SOUND', 'default'),
    ],
];
