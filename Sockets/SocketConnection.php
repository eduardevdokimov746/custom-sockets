<?php

namespace App\Sockets;

use App\Sockets\Abstracts\AbstractSocketConnection;
use Ratchet\ConnectionInterface;

class SocketConnection extends AbstractSocketConnection
{
    public function __construct(ConnectionInterface $connection)
    {
        parent::__construct($connection);
    }
}
