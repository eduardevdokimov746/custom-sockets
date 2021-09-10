<?php

namespace App\Sockets;

class Message
{
    private string $action;

    public function __construct(string $message)
    {
        $this->decode($message);
    }

    protected function decode(string $message)
    {
        $message = json_decode($message, 1);

        $this->action = $message['action'] ?? '';
    }

    public function getAction(): string
    {
        return $this->action;
    }
}
