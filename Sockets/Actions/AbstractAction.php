<?php

namespace App\Sockets\Actions;

use App\Sockets\ActionsStorage;
use App\Sockets\Interfaces\SocketActionInterface;
use App\Sockets\SocketChannels;

abstract class AbstractAction implements SocketActionInterface
{
    protected ActionsStorage $actions;
    protected SocketChannels $channels;

    public function __construct()
    {

    }
}
