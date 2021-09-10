<?php

namespace App\Sockets;

use Illuminate\Support\Collection;

class SocketEvent
{
    private string $title;
    private Collection $subscribers;

    public function __construct(string $title)
    {
        $this->subscribers = collect();
        $this->title = $title;
    }

    public function subscribe(SocketConnection $connection)
    {
        if (!$this->subscribers->has($connection->getId())) {
            $this->subscribers->put($connection->getId(), $connection);
        }
    }

    public function unsubscribe(SocketConnection $connection)
    {
        if ($this->subscribers->has($connection->getId())) {
            $this->subscribers->forget($connection->getId());
        }
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSubscribers(): Collection
    {
        return $this->subscribers;
    }
}
