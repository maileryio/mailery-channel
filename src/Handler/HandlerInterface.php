<?php

namespace Mailery\Channel\Handler;

use Mailery\Campaign\Entity\Sendout;
use Mailery\Campaign\Entity\Recipient;
use Mailery\Channel\Model\ChannelTypeInterface;

interface HandlerInterface
{

    /**
     * @param ChannelTypeInterface $channelType
     * @return self
     */
    public function withChannelType(ChannelTypeInterface $channelType): self;

    /**
     * @param self $handler
     * @return self
     */
    public function setNext(HandlerInterface $handler): HandlerInterface;

    /**
     * @param Sendout $sendout
     * @param Recipient $recipient
     * @return bool
     */
    public function handle(Sendout $sendout, Recipient $recipient): bool;
}
