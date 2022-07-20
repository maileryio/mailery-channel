<?php

namespace Mailery\Channel\Messenger\Stamp;

use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Messenger\Stamp\StampInterface;

class TransportStamp implements StampInterface
{

    /**
     * @param TransportInterface $transport
     */
    public function __construct(
        private TransportInterface $transport
    ) {}

    /**
     * @return TransportInterface
     */
    public function getTransport(): TransportInterface
    {
        return $this->transport;
    }

}
