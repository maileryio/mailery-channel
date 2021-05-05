<?php

use Mailery\Channel\Entity\Channel;
use Mailery\Channel\Model\ChannelTypeList;
use Mailery\Channel\Repository\ChannelRepository;
use Psr\Container\ContainerInterface;
use Cycle\ORM\ORMInterface;

return [
    ChannelTypeList::class => [
        '__construct()' => [
            'elements' => $params['maileryio/mailery-channel']['types'],
        ],
    ],
    ChannelRepository::class => static function (ContainerInterface $container) {
        return $container
            ->get(ORMInterface::class)
            ->getRepository(Channel::class);
    },
];
