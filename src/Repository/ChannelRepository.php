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
use Cycle\ORM\Select;
use Mailery\Cycle\Mapper\Data\Reader\Inheritance;
use Mailery\Cycle\Mapper\Data\Reader\InheritanceDataReader;

class ChannelRepository extends Repository
{
    /**
     * @param Inheritance $inheritance
     * @param Select $select
     */
    public function __construct(
        private Inheritance $inheritance,
        Select $select
    ) {
        parent::__construct($select);
    }

    /**
     * @param mixed $id
     * @return object|null
     */
    public function findByPK(mixed $id): ?object
    {
        return $this->inheritance->inherit(parent::findByPK($id));
    }

    /**
     * @param array $scope
     * @param array $orderBy
     * @return DataReaderInterface
     */
    public function getDataReader(array $scope = [], array $orderBy = []): DataReaderInterface
    {
        return new InheritanceDataReader(
            $this->inheritance,
            $this->select()->where($scope)->orderBy($orderBy)
        );
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
