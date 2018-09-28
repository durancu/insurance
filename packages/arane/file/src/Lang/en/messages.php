<?php

return [
    'notifications' => [

    ],
    'responses' => [
        'find' => [
            'success' => [
                'message' => 'File #:id found.',
                'code' => '200'
            ],
            'error' => [
                'message' => 'File #:id not found.',
                'code' => '404'
            ]
        ]
    ]

];