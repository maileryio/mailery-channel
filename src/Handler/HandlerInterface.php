<?php

namespace Mailery\Channel\Handler;

use Mailery\Campaign\Entity\Sendout;
use Mailery\Campaign\Entity\Recipient;

interface HandlerInterface
{
    /**
     * @param bool $suppressErrors
     * @return self
     */
    public function withSuppressErrors(bool $suppressErrors): self;

    /**
     * @param Sendout $sendout
     * @param \Iterator|Recipient[] $recipients
     * @return bool
     */
    public function handle(Sendout $sendout, \Iterator|array $recipients): bool;
}
