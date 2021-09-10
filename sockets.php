<?php

return [
    'port' => env('SOCKET_PORT', 6001),



    'actions' => [
        'login' => \App\Sockets\Actions\LoginAction::class
    ]
];
