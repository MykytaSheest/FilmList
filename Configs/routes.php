<?php
return [
    '' => [
        'controller' => 'film',
        'action' => 'index',
    ],
    'film/create' => [
        'controller' => 'film',
        'action' => 'create',
    ],
    'film/delete' => [
        'controller' => 'film',
        'action' => 'delete',
    ],
    'film/search' => [
        'controller' => 'film',
        'action' => 'search',
    ],
    'film/file' => [
        'controller' => 'film',
        'action' => 'upload',
    ],
    'register' => [
        'controller' => 'auth',
        'action' => 'register',
    ],
    'login' => [
        'controller' => 'auth',
        'action' => 'login'
    ],
    'logout' => [
        'controller' => 'auth',
        'action' => 'logout'
    ]
];
