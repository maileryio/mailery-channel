<?php

namespace Mailery\Channel\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Mailery\Channel\Model\ChannelTypeInterface;
use Mailery\Channel\Entity\Channel;

class ChannelTypeList extends ArrayCollection
{
    /**
     * @param Channel $channel
     * @return ChannelTypeInterface|null
     */
    public function findByEntity(Channel $channel): ?ChannelTypeInterface
    {
        return $this->filter(function (ChannelTypeInterface $channelType) use($channel) {
            return $channelType->isEntitySameType($channel);
        })->first() ?: null;
    }
}
