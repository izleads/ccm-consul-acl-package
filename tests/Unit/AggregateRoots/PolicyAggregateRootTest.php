<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\AggregateRoots;

use ConsulConfigManager\Consul\ACL\Events\Policy\PolicyCreated;
use ConsulConfigManager\Consul\ACL\Events\Policy\PolicyDeleted;
use ConsulConfigManager\Consul\ACL\Events\Policy\PolicyUpdated;
use ConsulConfigManager\Consul\ACL\AggregateRoots\PolicyAggregateRoot;

/**
 * Class PolicyAggregateRootTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\AggregateRoots
 */
class PolicyAggregateRootTest extends AbstractAggregateRootTest
{
    /**
     * @inheritDoc
     */
    protected string $uuid = 'c1dbd8d3-9547-4d2a-a181-ec035fbaaaed';

    /**
     * Common policy id
     * @var string
     */
    protected string $id = '1e8f8bb7-0111-450a-3f05-56d4e3911bb9';

    /**
     * Common policy name
     * @var string
     */
    private string $name = 'example_policy';

    /**
     * Common policy description
     * @var string
     */
    private string $description = 'This is an example policy.';

    /**
     * Common policy rules
     * @var string
     */
    private string $rules = '';

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromCreateMethod(): void
    {
        $instance = PolicyAggregateRoot::retrieve($this->uuid)
            ->createEntity(
                $this->id,
                $this->name,
                $this->description,
                $this->rules
            )
            ->persist();

        $this->assertInstanceOf(PolicyAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(PolicyCreated::class));
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromUpdateMethod(): void
    {
        $instance = PolicyAggregateRoot::retrieve($this->uuid)
            ->createEntity(
                $this->id,
                $this->name,
                $this->description,
                $this->rules
            )
            ->updateEntity(
                $this->name,
                'Hi',
                $this->rules
            )
            ->persist();
        $this->assertInstanceOf(PolicyAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(PolicyCreated::class));
        $this->assertTrue($this->hasEventStored(PolicyUpdated::class));
    }

    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfAggregateRootIsReturnedFromDeleteMethod(): void
    {
        $instance = PolicyAggregateRoot::retrieve($this->uuid)
            ->createEntity(
                $this->id,
                $this->name,
                $this->description,
                $this->rules
            )
            ->updateEntity(
                $this->name,
                'Hi',
                $this->rules
            )
            ->deleteEntity()
            ->persist();
        $this->assertInstanceOf(PolicyAggregateRoot::class, $instance);
        $this->assertTrue($this->hasEventStored(PolicyCreated::class));
        $this->assertTrue($this->hasEventStored(PolicyUpdated::class));
        $this->assertTrue($this->hasEventStored(PolicyDeleted::class));
    }
}
