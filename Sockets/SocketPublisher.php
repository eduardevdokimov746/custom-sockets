<?php

namespace App\Sockets;

use Illuminate\Support\Collection;

class SocketPublisher
{
    private Collection $events;

    public function __construct()
    {
        $this->events = collect();
    }

    public function publish(string $event)
    {
        if ($this->events->has($event)) {
            $this->events->get($event)->getSubscribers()->each(function ($connection) {
                $connection->send();
            });
        }
    }

    public function addEvent(SocketEvent $event)
    {
        $this->events->put($event->getTitle(), $event);
    }
}
