<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\Events\Role;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\ACL\Events\Role\RoleDeleted;

/**
 * Class RoleDeletedTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\Events\Role
 */
class RoleDeletedTest extends AbstractRoleEventTest
{
    /**
     * @inheritDoc
     */
    protected string $activeEventHandler = RoleDeleted::class;

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfEventCanBeCreated(array $data): void
    {
        $this->assertInstanceOf(RoleDeleted::class, $this->createClassInstance($data));
    }

    /**
     * @inheritDoc
     */
    protected function createClassInstance(array $data): RoleDeleted
    {
        return new $this->activeEventHandler(
            Arr::get($data, 'user')
        );
    }
}
