<?php

namespace App\Sockets\Abstracts;

use App\Sockets\Interfaces\SocketConnectionInterface;
use Ratchet\ConnectionInterface;

abstract class AbstractSocketConnection implements SocketConnectionInterface
{
    protected ConnectionInterface $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function getId(): string
    {
        return $this->connection->resourceId;
    }

    public function send(string $data)
    {
        $this->connection->send($data);
    }
}
