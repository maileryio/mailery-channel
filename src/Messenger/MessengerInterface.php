<?php

namespace Mailery\Channel\Messenger;

interface MessengerInterface
{

    /**
     * @param MessageInterface $message
     * @return void
     */
    public function send(MessageInterface $message): void;

}