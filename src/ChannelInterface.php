<?php

namespace Mailery\Channel;

interface ChannelInterface
{
    public function getKey(): string;

    public function getLabel(): string;
}
