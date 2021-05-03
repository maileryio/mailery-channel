<?php

namespace Mailery\Channel\Mapper;

use Mailery\Activity\Log\Mapper\LoggableMapper;
use Mailery\Channel\Module;

/**
 * @Cycle\Annotated\Annotation\Table(
 *      columns = {
 *          "created_at": @Cycle\Annotated\Annotation\Column(type = "datetime"),
 *          "updated_at": @Cycle\Annotated\Annotation\Column(type = "datetime"),
 *          "_type": @Cycle\Annotated\Annotation\Column(type = "string(255)")
 *      }
 * )
 */
final class ChannelMapper extends LoggableMapper
{
    /**
     * {@inheritdoc}
     */
    protected function getModule(): string
    {
        return Module::NAME;
    }
}
