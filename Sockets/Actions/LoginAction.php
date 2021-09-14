<?php

namespace App\Sockets\Actions;

use App\Sockets\Interfaces\SocketActionInterface;

class LoginAction implements SocketActionInterface
{
    public function action()
    {
        var_dump('логин');
    }
}
