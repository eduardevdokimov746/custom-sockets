<?php

namespace App\Sockets;

use Ratchet\ConnectionInterface;

class SocketConnection
{
    private int $id;
    private $connection;

    public function __construct(int $id, ConnectionInterface $connection)
    {
        $this->id = $id;
        $this->connection = $connection;
    }

    public function send()
    {
        $this->connection->send();
    }

    public function getId(): int
    {
        return $this->id;
    }
}
