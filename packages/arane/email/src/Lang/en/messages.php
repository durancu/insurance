<?php

return [
    'notifications' => [
        'email' => [
            'email-send' => [
                'success' => [
                    'subject' => 'Email Send Notification (Success)',
                    'message' => 'Email was sent.'
                ],
                'error' => [
                    'subject' => 'Email Send Notification (Error)',
                    'message' => 'Dear Admin, \n There was an send email error on Email Service.'
                ]
            ]
        ],
        'database' => [
            'email-send' => [
                'success' => [
                    'subject' => 'Email Send Notification (Success)',
                    'message' => 'Email was sent.'
                ],
                'error' => [
                    'subject' => 'Email Send Notification (Error)',
                    'message' => 'Error sending email.'
                ]
            ]
        ],
        'sms' => [
            'email-send' => [
                'success' => [
                    'subject' => 'Email Send Notification (Success)',
                    'message' => 'Email was sent.'
                ],
                'error' => [
                    'subject' => 'Email Send Notification (Error)',
                    'message' => 'Error sending email.'
                ]
            ]
        ]
    ],
    'responses' => [
        'send' => [
            'success' => [
                'message' => 'Email was sent',
                'code' => '200'
            ],
            'error' => [
                'message' => 'Email send failed',
                'code' => '500'
            ]
        ]
    ]
];