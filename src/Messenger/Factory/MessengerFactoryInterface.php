<?php

namespace Mailery\Channel\Messenger\Factory;

use Mailery\Channel\Messenger\MessengerInterface;

interface MessengerFactoryInterface
{

    /**
     * @param object $channel
     * @return self
     */
    public function withChannel(object $channel): self;

    /**
     * @return MessengerInterface
     */
    public function create(): MessengerInterface;

}
