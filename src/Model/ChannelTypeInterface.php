<?php

namespace Mailery\Channel\Model;

use Mailery\Channel\Handler\HandlerInterface;
use Mailery\Campaign\Recipient\Model\RecipientIterator;
use Mailery\Channel\Entity\Channel;

interface ChannelTypeInterface
{
    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return string
     */
    public function getCreateLabel(): string;

    /**
     * @return string|null
     */
    public function getCreateRouteName(): ?string;

    /**
     * @return array
     */
    public function getCreateRouteParams(): array;

    /**
     * @return HandlerInterface
     */
    public function getHandler(): HandlerInterface;

    /**
     * @return RecipientIterator
     */
    public function getRecipientIterator(): RecipientIterator;

    /**
     * @param object $entity
     * @return bool
     */
    public function isEntitySameType(Channel $entity): bool;
}
