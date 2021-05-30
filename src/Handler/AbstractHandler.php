<?php

namespace Mailery\Channel\Handler;

use Mailery\Campaign\Entity\Sendout;
use Mailery\Campaign\Entity\Recipient;
use Mailery\Channel\Handler\HandlerInterface;
use Mailery\Channel\Model\ChannelTypeInterface;

abstract class AbstractHandler implements HandlerInterface
{

    /**
     * @var HandlerInterface
     */
    private ?HandlerInterface $nextHandler = null;

    /**
     * @var ChannelTypeInterface|null
     */
    private ?ChannelTypeInterface $channelType = null;

    /**
     * @param HandlerInterface $handler
     * @return HandlerInterface
     */
    public function setNext(HandlerInterface $handler): HandlerInterface
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    /**
     * @param ChannelTypeInterface $channelType
     * @return self
     */
    public function withChannelType(ChannelTypeInterface $channelType): self
    {
        $new = clone $this;
        $new->channelType = $channelType;

        if ($new->nextHandler !== null) {
            $new->nextHandler = $new->nextHandler->withChannelType($channelType);
        }

        return $new;
    }

    /**
     * @param Sendout $sendout
     * @param Recipient $recipient
     * @return bool
     */
    public function handle(Sendout $sendout, Recipient $recipient): bool
    {
        if ($this->nextHandler !== null) {
            return $this->nextHandler->handle($sendout, $recipient);
        }
        return false;
    }

    /**
     * @return ChannelTypeInterface|null
     */
    protected function getChannelType(): ?ChannelTypeInterface
    {
        return $this->channelType;
    }
}
