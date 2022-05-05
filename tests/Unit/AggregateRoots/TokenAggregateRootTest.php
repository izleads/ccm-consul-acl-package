<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\AggregateRoots;

use ConsulConfigManager\Consul\ACL\Events\Token\TokenCreated;
use ConsulConfigManager\Consul\ACL\Events\Token\TokenDeleted;
use ConsulConfigManager\Consul\ACL\Events\Token\TokenUpdated;
use ConsulConfigManager\Consul\ACL\AggregateRoots\TokenAggregateRoot;

/**
 * Class TokenAggregateRootTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\AggregateRoots
 */
class TokenAggregateRootTest extends AbstractAggregateRootTest
{
    /**
     * @inheritDoc
     */
    protected string $uuid = 'c1dbd8d3-9547-4d2a-a181-ec035fbaaaed';

    /**
     * Token accessor id
     * @var string
     */
    protected string $id = '53cc7857-0263-4340-891c-1bdb0ce54aae';

    /**
     * Token secret id
     * @var string
     */
    protected string $secret = 'b109e841-d8c1-4548-b617-0d92ecaf0ded';

    /**
     * Token description
     * @var string
     */
    protected string $description = 'This is an example token.';

    /**
     * Token policies list
     * @var array
     */
    protected array $policies = [];

    /**
     * Token roles list
     * @var array
     */
    protected array $roles = [];

    /**
     * Determines whether token belongs to local datacenter only
     * @var bool
     */
    protected bool $local = false;

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromCreateMethod(): void
    {
        $instance = TokenAggregateRoot::retrieve($this->uuid)
            ->createEntity(
                $this->id,
                $this->secret,
                $this->description,
                $this->roles,
                $this->policies,
                $this->local,
            )
            ->persist();

        $this->assertInstanceOf(TokenAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(TokenCreated::class));
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromUpdateMethod(): void
    {
        $instance = TokenAggregateRoot::retrieve($this->uuid)
            ->createEntity(
                $this->id,
                $this->secret,
                $this->description,
                $this->roles,
                $this->policies,
                $this->local,
            )
            ->updateEntity(
                $this->secret,
                $this->description,
                $this->roles,
                $this->policies,
                $this->local,
            )
            ->persist();
        $this->assertInstanceOf(TokenAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(TokenCreated::class));
        $this->assertTrue($this->hasEventStored(TokenUpdated::class));
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromDeleteMethod(): void
    {
        $instance = TokenAggregateRoot::retrieve($this->uuid)
            ->createEntity(
                $this->id,
                $this->secret,
                $this->description,
                $this->roles,
                $this->policies,
                $this->local,
            )
            ->updateEntity(
                $this->secret,
                $this->description,
                $this->roles,
                $this->policies,
                $this->local,
            )
            ->deleteEntity()
            ->persist();
        $this->assertInstanceOf(TokenAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(TokenCreated::class));
        $this->assertTrue($this->hasEventStored(TokenUpdated::class));
        $this->assertTrue($this->hasEventStored(TokenDeleted::class));
    }
}
