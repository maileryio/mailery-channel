<?php

namespace Mailery\Channel\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Mailery\Channel\ChannelInterface;

class ChannelList extends ArrayCollection
{
    /**
     * @param array $channels
     */
    public function __construct(array $channels)
    {
        parent::__construct($channels);
    }
}
