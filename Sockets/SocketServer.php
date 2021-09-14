<?php

namespace App\Sockets;

use App\Http\Controllers\Api\Teh\AuthController;
use App\Http\Requests\Teh\Auth\LoginRequest;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class SocketServer implements MessageComponentInterface
{

    private MessageListener $messageListener;
    private SocketWorker $socketWorker;

    public function __construct()
    {
        $this->socketWorker = SocketContainer::worker();
        $this->messageListener = SocketContainer::listener();

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
        $this->socketWorker->open($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $this->messageListener->listen((new Message($msg)));
    }

    public function onClose(ConnectionInterface $conn) {
        $this->socketWorker->close($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $this->socketWorker->error($conn, $e);
    }
}
