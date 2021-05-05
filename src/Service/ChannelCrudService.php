<?php

namespace Mailery\Channel\Service;

use Cycle\ORM\ORMInterface;
use Mailery\Channel\Entity\Channel;
use Yiisoft\Yii\Cycle\Data\Writer\EntityWriter;

class ChannelCrudService
{
    /**
     * @var ORMInterface
     */
    private ORMInterface $orm;

    /**
     * @param ORMInterface $orm
     */
    public function __construct(ORMInterface $orm)
    {
        $this->orm = $orm;
    }

    /**
     * @param Channel $channel
     * @return bool
     */
    public function delete(Channel $channel): bool
    {
        (new EntityWriter($this->orm))->delete([$channel]);

        return true;
    }
}
