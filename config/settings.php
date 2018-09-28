<?php

return [
    //settings route
    'route' => 'settings',

    'middleware' => ['web', 'auth'],

    'api_prefix' => env('API_PREFIX', 'api/v1'),

    // hidden records not editable from interface when set to false
    'show_hidden_records' => false,

    //javascript format
    'date_format' => 'mm/dd/yyyy',
    // number of digits after the decimal point
    'number_step' => 0.001,

    // upload path for settings of type file
    'upload_path' => 'uploads/settings',

    // valid mime types for settings of type file
    'mimes' => 'jpg,jpeg,png,txt,csv,pdf',

    'per_page' => 10,

    // settings package table name the default is `settings`
    'table' => 'settings',

    //set user default activation value
    'activation' => env('ACTIVATION', false),

    'notification-channel' => 'database',

    'business-client' => env('BUSINESS_CLIENT', 'default'),

    'models' => [
        'user' => 'Arane\Base\Models\Entities\User',
    ],

    'theme' => [
        'dark' => [
            'main' => [
                'back-color' => '#333333',
                'font-color' => '#f9f9f9'
            ],
            'secondary' => [
                'back-color' => '#707070',
                'font-color' => '#ffffff'
            ],
        ],
        'light' => [
            'main' => [
                'back-color' => '#f0f0f0',
                'font-color' => '#333333'
            ],
            'secondary' => [
                'back-color' => '#f9f9f9',
                'font-color' => '#000000'
            ],
        ]
    ],

    'current_theme' => 'dark',

    'company' => [
        'name' => 'Company name'
    ],


    //LOG SETTINGS
    'logs' => [

    ],

    //USER SETTINGS
    'user' => [
        'activation' => [
            'max-attempts' => env('USER_ACTIVATION_MAX_ATTEMPTS', 3),
        ],
        'roles' => [
            'standard' => 'user'
        ],
        'super-admin' => [
            'user-id' => 1,
        ],
        'admins' => [
            'edge-role-id' => 3
        ]
    ],

    //CAPTCHA SETTINGS
    'captcha' => [
        'enabled' => env('RE_CAP_ENABLED', true),
        'secret' => env('RE_CAP_SECRET'),
        'site-key' => env('RE_CAP_SITE_KEY')
    ],

    //DISK SETTINGS
    'disk' => [
        's3' => [
            'paths' => [
                'default' => env('DISK_S3_PATH_DEFAULT', 'files'),
                'others' => env('DISK_S3_PATH_OTHERS', 'unclassified'),
                'trash' => env('DISK_LOCAL_PATH_TRASH', 'trash'),
            ]
        ],
        'local' => [
            'paths' => [
                'default' => env('DISK_LOCAL_PATH_DEFAULT', 'files'),
                'others' => env('DISK_LOCAL_PATH_OTHERS', 'unclassified'),
                'trash' => env('DISK_LOCAL_PATH_TRASH', 'trash'),
            ]
        ]
    ],

    //STORAGE SETTINGS
    'storage' => [
        'disk' => env('FILE_DISK', 's3'),
    ],

    //SOCIALITE SETTINGS
    'socialite' => [
        'clients' => [
            'personal' => [
                'web' => [
                    'id' => env('PERSONAL_CLIENT_ID'),
                    'secret' => env('PERSONAL_CLIENT_SECRET', null)
                ]
            ],
            'password' => [
                'web' => [
                    'id' => env('PASSWORD_CLIENT_ID'),
                    'secret' => env('PASSWORD_CLIENT_SECRET', null)
                ]
            ]
        ],
        'routes' => [
            'redirect_prefix' => env('SOCIAL_PROVIDER_REDIRECT_PATH'),
            //'redirect_url' => env('APP_URL').'/'.env('API_PREFIX').'/'.env('SOCIAL_PROVIDER_REDIRECT_PATH')
            'redirect_url' => env('APP_URL') . '/social/providers/handle'
        ],
    ]

];