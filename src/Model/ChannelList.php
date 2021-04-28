<?php

namespace Mailery\Channel\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Mailery\Brand\Entity\Brand;
use Mailery\Channel\ChannelInterface as Channel;
use Mailery\Campaign\Entity\Campaign;

class ChannelList extends ArrayCollection
{
    /**
     * @param array $channels
     */
    public function __construct(array $channels)
    {
        parent::__construct($channels);
    }

    /**
     * @param Brand $brand
     * @return self
     */
    public function filterByBrand(Brand $brand): self
    {
        return $this->filter(function (Channel $channel) use($brand) {
            return $brand->hasChannel($channel->getName());
        });
    }

    /**
     * @param Campaign $campaign
     * @return self
     */
    public function filterByCampaign(Campaign $campaign): self
    {
        return $this->filter(function (Channel $channel) use($campaign) {
            return $channel->getName() === $campaign->getChannel();
        });
    }
}
