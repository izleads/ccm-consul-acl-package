<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\AggregateRoots;

use ConsulConfigManager\Consul\ACL\Events\Role\RoleCreated;
use ConsulConfigManager\Consul\ACL\Events\Role\RoleDeleted;
use ConsulConfigManager\Consul\ACL\Events\Role\RoleUpdated;
use ConsulConfigManager\Consul\ACL\AggregateRoots\RoleAggregateRoot;

/**
 * Class RoleAggregateRootTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\AggregateRoots
 */
class RoleAggregateRootTest extends AbstractAggregateRootTest
{
    /**
     * @inheritDoc
     */
    protected string $uuid = 'c1dbd8d3-9547-4d2a-a181-ec035fbaaaed';

    /**
     * Common role id
     * @var string
     */
    protected string $id = '1e8f8bb7-0111-450a-3f05-56d4e3911bb9';

    /**
     * Common role name
     * @var string
     */
    private string $name = 'example_role';

    /**
     * Common role description
     * @var string
     */
    private string $description = 'This is an example role.';

    /**
     * Common role policies
     * @var array
     */
    private array $policies = [];

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromCreateMethod(): void
    {
        $instance = RoleAggregateRoot::retrieve($this->uuid)
            ->createEntity(
                $this->id,
                $this->name,
                $this->description,
                $this->policies
            )
            ->persist();

        $this->assertInstanceOf(RoleAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(RoleCreated::class));
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromUpdateMethod(): void
    {
        $instance = RoleAggregateRoot::retrieve($this->uuid)
            ->createEntity(
                $this->id,
                $this->name,
                $this->description,
                $this->policies
            )
            ->updateEntity(
                $this->name,
                'Hi',
                $this->policies
            )
            ->persist();
        $this->assertInstanceOf(RoleAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(RoleCreated::class));
        $this->assertTrue($this->hasEventStored(RoleUpdated::class));
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromDeleteMethod(): void
    {
        $instance = RoleAggregateRoot::retrieve($this->uuid)
            ->createEntity(
                $this->id,
                $this->name,
                $this->description,
                $this->policies
            )
            ->updateEntity(
                $this->name,
                'Hi',
                $this->policies
            )
            ->deleteEntity()
            ->persist();
        $this->assertInstanceOf(RoleAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(RoleCreated::class));
        $this->assertTrue($this->hasEventStored(RoleUpdated::class));
        $this->assertTrue($this->hasEventStored(RoleDeleted::class));
    }
}
