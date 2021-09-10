<?php

namespace App\Sockets\Actions;

use App\Sockets\SocketActionInterface;

class LoginAction implements SocketActionInterface
{
    public function action()
    {
        var_dump('логин');
    }
}
