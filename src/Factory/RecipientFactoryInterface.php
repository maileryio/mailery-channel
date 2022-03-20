<?php

namespace Mailery\Channel\Factory;

use Mailery\Campaign\Entity\Recipient;
use Mailery\Subscriber\Entity\Subscriber;

interface RecipientFactoryInterface
{
    /**
     * @param Subscriber $subscriber
     * @return Recipient
     */
    public function fromSubscriber(Subscriber $subscriber): Recipient;

    /**
     * @param string $identificator
     * @return Recipient[]
     */
    public function fromIdentificator(string $identificator): array;
}
