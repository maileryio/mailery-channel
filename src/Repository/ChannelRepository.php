<?php

namespace Mailery\Channel\Repository;

use Cycle\ORM\Select\Repository;
use Spiral\Database\Injection\Parameter;
use Spiral\Database\Injection\Expression;
use Yiisoft\Data\Reader\DataReaderInterface;
use Mailery\Channel\Filter\ChannelFilter;
use Yiisoft\Data\Paginator\PaginatorInterface;
use Yiisoft\Data\Paginator\OffsetPaginator;
use Yiisoft\Data\Reader\Sort;
use Mailery\Brand\Entity\Brand;
use Mailery\Channel\Entity\Channel;
use Yiisoft\Yii\Cycle\Data\Reader\EntityReader;

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
                Sort::only(['id'])->withOrder(['id' => 'desc'])
            )
        );
    }

    /**
     * @param Brand $brand
     * @return self
     */
    public function withBrand(Brand $brand): self
    {
        $repo = clone $this;

        $channelIds = $brand->getChannels()->map(
            fn (Channel $channel) => $channel->getId()
        )->toArray();

        if (empty($channelIds)) {
            $repo->select->where(new Expression('1 = 0'));
        } else {
            $repo->select
                ->andWhere([
                    'id' => ['in' => new Parameter($channelIds, \PDO::PARAM_INT)],
                ]);
        }

        return $repo;
    }
}
