<?php

namespace App\Sockets;

use Illuminate\Support\Collection;

class ActionsStorage
{
    private ActionsLoader $actionsLoader;
    private Collection $actions;

    public function __construct()
    {
        $this->actionsLoader = new ActionsLoader();
        $this->actions = $this->actionsLoader->load();
    }

    public function get(string $title): SocketActionInterface
    {
        if ($this->actions->has($title)) {
            return $this->actions->get($title);
        }
    }

    public function has(string $title)
    {
        return $this->actions->has($title);
    }
}
