<?php

use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Definitions\DynamicReference;
use Mailery\Channel\Entity\Channel;

return [
    'yiisoft/yii-cycle' => [
        'entity-paths' => [
            '@vendor/maileryio/mailery-channel/src/Entity',
        ],
    ],

    'maileryio/mailery-activity-log' => [
        'entity-groups' => [
            'channel' => [
                'label' => DynamicReference::to(static fn () => 'Channel'),
                'entities' => [
                    Channel::class,
                ],
            ],
        ],
    ],

    'maileryio/mailery-channel' => [
        'types' => [],
        'handlers' => [],
    ],

    'maileryio/mailery-menu-navbar' => [
        'items' => [
            'system' => [
                'items' => [
                    'channels' => [
                        'label' => static function () {
                            return 'Channels';
                        },
                        'url' => static function (UrlGeneratorInterface $urlGenerator) {
                            return strtok($urlGenerator->generate('/channel/default/index'), '?');
                        },
                    ],
                ],
            ],
        ],
    ],
];
