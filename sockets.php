<?php

return [
    'port' => env('SOCKET_PORT', 6001),

    'defaultChannel' => 'main',

    'components' => [
        'publisher' => \App\Sockets\SocketPublisher::class,
        'channels' => \App\Sockets\SocketChannels::class,
        'listener' => \App\Sockets\MessageListener::class,
        'worker' => \App\Sockets\SocketWorker::class
    ],

    'actions' => [
        'login' => \App\Sockets\Actions\LoginAction::class
    ]
];
