<?php

return [
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
];