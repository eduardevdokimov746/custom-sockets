<?php

namespace App\Sockets;

use App\Http\Controllers\Api\Teh\AuthController;
use App\Http\Requests\Teh\Auth\LoginRequest;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class SocketServer implements MessageComponentInterface
{
    private SocketPublisher $publisher;
    private SocketChannels $channels;
    private MessageListener $messageListener;

    public function __construct()
    {
        $this->messageListener = new MessageListener();
        $this->channels = new SocketChannels();
        $this->channels->add('main');
/*
        $request = new LoginRequest([
            'username' => 'ens',
            'password' => 'ens',
            'hash' => '123'
        ]);

        $request->setContainer(app())
            ->setRedirector(app(\Illuminate\Routing\Redirector::class))
            ->validateResolved();

        // Вызываем метод контролера
        app()
            ->make(AuthController::class)
            ->callAction('login', [$request])
            ->getData();
*/
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->channels->addConnection(
            'main',
            (new SocketConnection($conn->resourceId, $conn))
        );

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $this->messageListener->listen((new Message($msg)));



    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
