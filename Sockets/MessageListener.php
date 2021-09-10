<?php

namespace App\Sockets;

class MessageListener
{
    private ActionsStorage $actions;

    public function __construct()
    {
        $this->actions = new ActionsStorage();
    }

    public function listen(Message $message)
    {
        if ($this->actions->has($message->getAction())) {
            $this->actions->get($message->getAction())->action();
        }


//        $numRecv = count($this->clients) - 1;
//        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
//            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
//
//        foreach ($this->clients as $client) {
//            if ($from !== $client) {
//                // The sender is not the receiver, send to each client connected
//                $client->send($msg);
//            }
//        }
    }
}
