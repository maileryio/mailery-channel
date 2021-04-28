<?php

namespace Mailery\Channel;

interface ChannelInterface
{
    public function getName(): string;

    public function getLabel(): string;

    public function getRecipientFactory(): RecipientFactoryInterface;
}
