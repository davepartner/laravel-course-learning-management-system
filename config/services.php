<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],'facebook' => [
        'client_id' => '3174755132597763',         // Your Facebook Client ID
        'client_secret' => 'a594a068b8ffa648def0ee7c2ad6312c', // Your Facebook Client Secret
        'redirect' => 'https://35.231.223.153/login/facebook/callback',
    ],'google' => [
        'client_id' => '883841150466-sfp0diqg7qvc05jhi0ecl65v3u80vk9i.apps.googleusercontent.com',         // Your google Client ID
        'client_secret' => 'DvfY-pk_UDGxvCjCHPF564Zb', // Your google Client Secret
        'redirect' => 'http://35.231.223.153/login/google/callback',
    ],

];
