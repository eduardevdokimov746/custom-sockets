<?php

namespace App\Sockets;

use Illuminate\Support\Collection;

class SocketChannels
{
    private Collection $channels;

    public function __construct()
    {
        $this->channels = collect();
        $this->addDefaultChannel();
    }

    public function add(string $title)
    {
        if ($this->channels->has($title)) {
            echo 'Канал с именем ' . $title . ' уже существует!';
            return;
        }

        $channel = new SocketChannel($title);

        $this->channels->put($title, $channel);
    }

    public function get(string $title): SocketChannel
    {
        return $this->channels->get($title);
    }

    public function getDefaultChannel(): SocketChannel
    {
        return $this->get(config('sockets.defaultChannel'));
    }

    protected function addDefaultChannel()
    {
        $this->add(config('sockets.defaultChannel'));
    }
}
