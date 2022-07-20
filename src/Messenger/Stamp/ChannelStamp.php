<?php

namespace Mailery\Channel\Messenger\Stamp;

use Mailery\Channel\Entity\Channel;
use Symfony\Component\Messenger\Stamp\StampInterface;

class ChannelStamp implements StampInterface
{

    /**
     * @param Channel $channel
     */
    public function __construct(
        private Channel $channel
    ) {}

    /**
     * @return Channel
     */
    public function getChannel(): Channel
    {
        return $this->channel;
    }

}
