<?php
/**
 * Created by PhpStorm.
 * User: donesantana
 * Date: 2/20/18
 * Time: 10:54 PM
 */
return [
    'notifications' => [
        'create' => [
            'success' => [
                'subject' => 'New :ModelName Created',
                'message' => ':UserName (id #:userId) has created :ModelName #:id.'
            ],
            'error' => [
                'subject' => 'Error Creating New :ModelName',
                'message' => ':UserName (id #:userId) received an error when attempted to create new :ModelName.'
            ]
        ],
        'update' => [
            'success' => [
                'subject' => ':ModelName Updated',
                'message' => ':UserName (id #:userId) has updated :ModelName #:id.'
            ],
            'error' => [
                'subject' => 'Error Updating :ModelName #:id',
                'message' => ':UserName (id #:userId) received an error when attempted to update :ModelName #:id.'
            ]
        ],
        'delete' => [
            'success' => [
                'subject' => ':ModelName Deleted',
                'message' => ':UserName (id #:userId) has deleted :ModelName #:id.'
            ],
            'error' => [
                'subject' => 'Error Deleting :ModelName',
                'message' => ':UserName (id #:userId) received an error when attempted to delete :ModelName #:id.'
            ]
        ],
        'hard-delete' => [
            'success' => [
                'subject' => ':ModelName Permanently Deleted',
                'message' => ':UserName (id #:userId) has permanently deleted :ModelName #:id.'
            ],
            'error' => [
                'subject' => 'Error Deleting :ModelName Permanently',
                'message' => ':UserName (id #:userId) received an error when attempted to permanently delete :ModelName #:id.'
            ]
        ],
        'restore' => [
            'success' => [
                'subject' => ':ModelName Restored',
                'message' => ':UserName (id #:userId) has restored :ModelName #:id.'
            ],
            'error' => [
                'subject' => 'Error Restoring :ModelName #:id',
                'message' => ':UserName (id #:userId) received an error when attempted to restore :ModelName #:id.'
            ]
        ]
    ],
    'responses' => [
        'create' => [
            'success' => [
                'message' => ':ModelName #:id was created',
                'code' => '200'
            ],
            'error' => [
                'message' => ':ModelName #:id create failed',
                'code' => '500'
            ]
        ],
        'update' => [
            'success' => [
                'message' => ':ModelName #:id was updated',
                'code' => '200'
            ],
            'error' => [
                'message' => ':ModelName #:id update failed.',
                'code' => '500'
            ]
        ],
        'delete' => [
            'success' => [
                'message' => ':ModelName #:id was deleted',
                'code' => '200'
            ],
            'error' => [
                'message' => ':ModelName #:id delete failed',
                'code' => '500'
            ]
        ],
        'hard-delete' => [
            'success' => [
                'message' => ':ModelName #:id was permanently deleted',
                'code' => '200'
            ],
            'error' => [
                'message' => ':ModelName #:id permanent delete failed',
                'code' => '500'
            ]
        ],
        'restore' => [
            'success' => [
                'message' => ':ModelName #:id was restored',
                'code' => '200'
            ],
            'error' => [
                'message' => ':ModelName #:id restore failed.',
                'code' => '500'
            ]
        ],
        'find' => [
            'success' => [
                'message' => ':ModelName #:id found',
                'code' => '200'
            ],
            'error' => [
                'message' => ':ModelName #:id not found',
                'code' => '404'
            ]
        ],
        'share' => [
            'success' => [
                'message' => ':ModelName #:id was restored',
                'code' => '200'
            ],
            'error' => [
                'message' => ':ModelName #:id restore failed.',
                'code' => '500'
            ]
        ]
    ],
];