<?php

namespace Mailery\Channel\Entity;

use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Inheritance\DiscriminatorColumn;
use Mailery\Channel\Repository\ChannelRepository;
use Cycle\ORM\Entity\Behavior;
use Mailery\Activity\Log\Mapper\LoggableMapper;

/**
* This doc block required for STI/JTI
*/
#[Entity(
    table: 'channels',
    repository: ChannelRepository::class,
    mapper: LoggableMapper::class
)]
#[Behavior\CreatedAt(
    field: 'createdAt',
    column: 'created_at'
)]
#[Behavior\UpdatedAt(
    field: 'updatedAt',
    column: 'updated_at'
)]
#[DiscriminatorColumn(name: 'type')]
abstract class Channel
{
    #[Column(type: 'primary')]
    protected int $id;

    #[Column(type: 'string(255)')]
    protected string $name;

    #[Column(type: 'string(255)')]
    protected string $type;

    #[Column(type: 'datetime')]
    private \DateTimeImmutable $createdAt;

    #[Column(type: 'datetime', nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}