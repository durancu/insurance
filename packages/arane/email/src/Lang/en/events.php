<?php

return [
    'notifications' => [
        'send' => [
            'success' => [
                'subject' => 'New Email Sent',
                'message' => 'Email to :email has been sent.'
            ],
            'error' => [
                'subject' => 'Error Send Email To :email',
                'message' => 'There was an error sending an email to :email.'
            ]
        ],
    ],
    'responses' => [
            'send' => [
                'success' => [
                    'message' => 'Email To :email has been sent',
                    'code' => '200'
                ],
                'error' => [
                    'message' => 'Error Sending Email to :email',
                    'code' => '500'
                ]
            ],
        ],
];