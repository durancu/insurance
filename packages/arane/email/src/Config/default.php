<?php

return [

    'connection' => env('MAIL_CONNECTION', 'sqs'),
    'queue' => env('MAIL_QUEUE', 'emails'),
    'default-view' => env('DEFAULT_MAIL_VIEW', 'email::system-notification'),
    //Mail priority: 1-High, 2-Normal, 3-Low
    'priority' => env('MAIL_PRIORITY', 2),
    'log-events' => env('MAIL_LOG_EVENTS', false),
];