<?php

namespace App\Sockets;

use App\Sockets\Interfaces\SocketConnectionInterface;
use Illuminate\Support\Collection;

class SocketChannel implements SocketConnectionInterface
{
    private string $id;
    private Collection $connections;

    public function __construct(string $title)
    {
        $this->connections = collect();
        $this->id = $title;
    }

    public function addConnection(SocketConnectionInterface $conn)
    {
        $this->connections->put($conn->getId(), $conn);
    }

    public function send(string $data)
    {
        $this->connections->each(function ($connection) use ($data) {
            /** @var SocketConnectionInterface $connection */
            $connection->send($data);
        });
    }

    public function getId()
    {
        return $this->id;
    }
}
