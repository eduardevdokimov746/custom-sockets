<?php

namespace App\Sockets\Init;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Sockets\SocketServer;

class SocketServerWorker
{
    public function run()
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new SocketServer()
                )
            ),
            config('sockets.port')
        );

        $server->run();
    }
}
