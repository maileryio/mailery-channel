<?php

namespace Mailery\Channel\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Mailery\Channel\Model\ChannelTypeInterface;

class ChannelTypeList extends ArrayCollection
{
    /**
     * @param object $channel
     * @return ChannelTypeInterface|null
     */
    public function findByEntity(object $channel): ?ChannelTypeInterface
    {
        return $this->filter(function (ChannelTypeInterface $channelType) use($channel) {
            return $channelType->isEntitySameType($channel);
        })->first() ?: null;
    }
}
