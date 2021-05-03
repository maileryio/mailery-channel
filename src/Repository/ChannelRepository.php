<?php

namespace Mailery\Channel\Repository;

use Cycle\ORM\Select\Repository;
use Yiisoft\Yii\Cycle\Data\Reader\EntityReader;
use Yiisoft\Data\Reader\DataReaderInterface;
use Mailery\Channel\Filter\ChannelFilter;
use Yiisoft\Data\Paginator\PaginatorInterface;
use Yiisoft\Data\Paginator\OffsetPaginator;
use Yiisoft\Data\Reader\Sort;

class ChannelRepository extends Repository
{
    /**
     * @param array $scope
     * @param array $orderBy
     * @return DataReaderInterface
     */
    public function getDataReader(array $scope = [], array $orderBy = []): DataReaderInterface
    {
        return new EntityReader($this->select()->where($scope)->orderBy($orderBy));
    }

    /**
     * @param ChannelFilter $filter
     * @return PaginatorInterface
     */
    public function getFullPaginator(ChannelFilter $filter): PaginatorInterface
    {
        $dataReader = $this->getDataReader();

        if (!$filter->isEmpty()) {
            $dataReader = $dataReader->withFilter($filter);
        }

        return new OffsetPaginator(
            $dataReader->withSort(
                Sort::only(['id'])->withOrder(['id' => 'DESC'])
            )
        );
    }
}
