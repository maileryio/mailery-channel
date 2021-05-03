<?php

namespace Mailery\Channel;

interface ChannelInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return RecipientFactoryInterface
     */
//    public function getRecipientFactory(): RecipientFactoryInterface;

    /**
     * @return MessageFactoryInterface
     */
//    public function getMessageFactory(): MessageFactoryInterface;
}
