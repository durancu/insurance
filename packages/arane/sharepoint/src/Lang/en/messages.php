<?php

return [
    'notifications' => [
        'share' => [
            'success' => [
                'subject' => 'Sharepoint File Shared',
                'message' => ':UserName (id #:userId) has shared Sharepoint File #:id.'
            ],
            'error' => [
                'subject' => 'Error Sharing Sharepoint File #:id',
                'message' => ':UserName (id #:userId) received an error when attempted to share Sharepoint File #:id.'
            ]
        ],
        'unshare' => [
            'success' => [
                'subject' => 'Sharepoint File Unshared',
                'message' => ':UserName (id #:userId) has unshared Sharepoint File #:id.'
            ],
            'error' => [
                'subject' => 'Error Unsharing Sharepoint File #:id',
                'message' => ':UserName (id #:userId) received an error when attempted to unshare Sharepoint File #:id.'
            ]
        ],
        'copy' => [
            'success' => [
                'subject' => 'Sharepoint File Copied',
                'message' => ':UserName (id #:userId) has copied Sharepoint File #:id.'
            ],
            'error' => [
                'subject' => 'Error Copying Sharepoint File #:id',
                'message' => ':UserName (id #:userId) received an error when attempted to copy Sharepoint File #:id.'
            ]
        ],
        'move' => [
            'success' => [
                'subject' => 'Sharepoint File Moved',
                'message' => ':UserName (id #:userId) has moved Sharepoint File #:id.'
            ],
            'error' => [
                'subject' => 'Error Moving Sharepoint File #:id',
                'message' => ':UserName (id #:userId) received an error when attempted to move Sharepoint File #:id.'
            ]
        ]
    ],
    'responses' => [
        'share' => [
            'success' => [
                'message' => 'Sharepoint File #:id was shared',
                'code' => '200'
            ],
            'error' => [
                'message' => 'Sharepoint File #:id shared failed.',
                'code' => '500'
            ]
        ],
        'unshare' => [
            'success' => [
                'message' => 'Sharepoint File #:id was unshared',
                'code' => '200'
            ],
            'error' => [
                'message' => 'Sharepoint File #:id unshared failed.',
                'code' => '500'
            ]
        ],
        'copy' => [
            'success' => [
                'message' => 'Sharepoint File #:id was copied',
                'code' => '200'
            ],
            'error' => [
                'message' => 'Sharepoint File #:id copy failed.',
                'code' => '500'
            ]
        ],
        'move' => [
            'success' => [
                'message' => 'Sharepoint File #:id was moved',
                'code' => '200'
            ],
            'error' => [
                'message' => 'Sharepoint File #:id move failed.',
                'code' => '500'
            ]
        ],
        'find' => [
            'success' => [
                'message' => 'Sharepoint File #:id found',
                'code' => '200'
            ],
            'error' => [
                'message' => 'Sharepoint File #:id not found',
                'code' => '404'
            ]
        ]
    ]
];