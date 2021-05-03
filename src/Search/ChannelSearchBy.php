<?php

namespace Mailery\Channel\Search;

use Mailery\Widget\Search\Model\SearchBy;

class ChannelSearchBy extends SearchBy
{
    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [self::getOperator(), 'name', $this->getSearchPhrase()];
    }

    /**
     * @inheritdoc
     */
    public static function getOperator(): string
    {
        return 'like';
    }
}
