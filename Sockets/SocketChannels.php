<?php

namespace App\Sockets;

use Illuminate\Support\Collection;

class SocketChannels
{
    private Collection $channels;

    public function __construct()
    {
        $this->channels = collect();
    }

    public function add(string $title)
    {
        $this->channels->put($title, collect());
    }

    public function get(string $title): Collection
    {
        return $this->channels->get($title);
    }

    public function addConnection(string $channel, SocketConnection $connection)
    {
        if (!$this->channels->has($channel)) {
            $this->get($channel)->put($connection->getId(), $connection);
        }
    }

    public function removeConnection(string $channel, SocketConnection $connection)
    {
        if ($this->channels->has($channel)) {
            $this->get($channel)->forget($connection->getId());
        }
    }
}
