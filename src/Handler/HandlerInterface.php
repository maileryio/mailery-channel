<?php

namespace Mailery\Channel\Handler;

use Mailery\Campaign\Entity\Sendout;
use Mailery\Campaign\Entity\Recipient;

interface HandlerInterface
{
    /**
     * @param Sendout $sendout
     * @param Recipient $recipient
     * @return bool
     */
    public function handle(Sendout $sendout, Recipient $recipient): bool;
}
