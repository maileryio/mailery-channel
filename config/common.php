<?php

use Mailery\Channel\Entity\Channel;
use Mailery\Channel\Model\ChannelList;
use Mailery\Channel\Repository\ChannelRepository;
use Psr\Container\ContainerInterface;
use Cycle\ORM\ORMInterface;

return [
    ChannelList::class => [
        '__construct()' => [
            'channels' => $params['maileryio/mailery-channel']['channels'],
        ],
    ],
    ChannelRepository::class => static function (ContainerInterface $container) {
        return $container
            ->get(ORMInterface::class)
            ->getRepository(Channel::class);
    },
];
