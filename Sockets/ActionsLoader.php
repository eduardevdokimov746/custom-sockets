<?php

namespace App\Sockets;

use App\Sockets\Interfaces\SocketActionInterface;
use Illuminate\Support\Collection;
use \Exception;

class ActionsLoader
{
    public function load(): Collection
    {
        $actions = collect();

        foreach (config('sockets.actions') as $title => $action) {
            if (!(($action = new $action) instanceof SocketActionInterface)) {
                throw new Exception($this->getErrorMessage($action));
            }

            $actions->put($title, $action);
        }

        return $actions;
    }

    protected function getErrorMessage(object $action): string
    {
        return 'Action must be type SocketActionInterface, ' . get_class($action) . ' given.';
    }
}
