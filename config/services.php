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
        'domain' => env('MAILGUN_DOMAIN', 'mailservice.swyftfilings.net'),
        'secret' => env('MAILGUN_SECRET', 'ba8ac77eec4ab63c65144ba01dd471b8-770f03c4-c695f682'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => 'Arane\Base\Models\Entities\User',
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    'braintree' => [
        'model'  => \Arane\Base\Models\Entities\User::class,
        'environment' => env('BRAINTREE_ENV','sandbox'),
        'merchant_id' => env('BRAINTREE_MERCHANT_ID', '6q9bzqw5hsmkxc3q'),
        'public_key' => env('BRAINTREE_PUBLIC_KEY', 'hmxtsjznn9gy6zjz'),
        'private_key' => env('BRAINTREE_PRIVATE_KEY', 'c03fb075ed56224dec488377ee4c3663'),
    ],
    
    'okta' => [
        'url' => env('OKTA_URL'),
        'client_id' => env('OKTA_CLIENT_ID', null),
        'client_secret' => env('OKTA_CLIENT_SECRET', null),
        'redirect' => env('OKTA_REDIRECT', env('APP_URL') . '/social/providers/handle/okta'),
    ],
    
    'facebook' => [
        'client_id'     => env('FB_ID', null),
        'client_secret' => env('FB_SECRET', null),
        'redirect'      => env('FB_REDIRECT',env('APP_URL') . '/social/providers/handle/facebook'),
    ],
    
    'twitter' => [
        'client_id'     => env('TW_ID', null),
        'client_secret' => env('TW_SECRET', null),
        'redirect'      => env('TW_REDIRECT', env('APP_URL') . '/social/providers/handle/twitter'),
    ],
    
    'google' => [
        'client_id'     => env('GOOGLE_ID', null),
        'client_secret' => env('GOOGLE_SECRET', null),
        'redirect'      => env('GOOGLE_REDIRECT', env('APP_URL') . '/social/providers/handle/google'),
        'recaptcha_key' => env('GOOGLE_RECAPTCHA_KEY', '6Lcp0nEUAAAAALm81dP9leSqZr1t-OiiSsAC9ayv'),
        'recaptcha_secret' => env('GOOGLE_RECAPTCHA_SECRET', '6Lcp0nEUAAAAADlaG8OWtN0-xpnZVjFuG4IXjJd_')
    ],
    
    'github' => [
        'client_id'     => env('GITHUB_ID', null),
        'client_secret' => env('GITHUB_SECRET', null),
        'redirect'      => env('GITHUB_REDIRECT', env('APP_URL') . '/social/providers/handle/github')
    ],
    'nexmo' => [
        'key' => env('NEXMO_KEY', null),
        'secret' => env('NEXMO_SECRET', null),
        'sms_from' => env('NEXMO_FROM', null),
    ],
    'sns' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1')
    ],
    'arane-oauth-password' => [
        'key' => env('PASSWORD_CLIENT_ID'),
        'secret' => env('PASSWORD_CLIENT_SECRET'),
    ],
    'arane-oauth-personal' => [
        'key' => env('PERSONAL_CLIENT_ID'),
        'secret' => env('PERSONAL_CLIENT_SECRET'),
    ],


];
