<?php

namespace App\Sockets\Interfaces;

interface SocketConnectionInterface
{
    public function send(string $data);

    public function getId();
}
