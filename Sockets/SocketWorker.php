<?php

namespace App\Sockets;

use Ratchet\ConnectionInterface;

class SocketWorker
{
    private SocketContainer $container;

    public function __construct()
    {
        $this->container = SocketContainer::getInstance();
    }

    public function open(ConnectionInterface $conn)
    {
        $connection = new SocketConnection($conn);

        /** @var SocketChannel $publicChannel */
        $publicChannel = $this->container->get('channels')->getDefaultChannel();
        $publicChannel->addConnection($connection);

        echo "New connection! ({$connection->getId()})\n Added in {$publicChannel->getId()} channel.";
    }

    public function close(ConnectionInterface $conn)
    {
        $this->container->get('connections')->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function error(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
