<?php

namespace Mailery\Channel\Handler;

use Mailery\Channel\Handler\AbstractHandler;

class RootHandler extends AbstractHandler
{
    /**
     * @param array $handlers
     */
    public function __construct(array $handlers)
    {
        $prevHandler = null;
        foreach ($handlers as $handler) {
            if ($prevHandler === null) {
                $prevHandler = $this;
            }
            $prevHandler = $prevHandler->setNext($handler);
        }
    }
}
