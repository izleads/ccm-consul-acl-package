<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\Events\Role;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\ACL\Events\Role\RoleCreated;

/**
 * Class RoleCreatedTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\Events\Role
 */
class RoleCreatedTest extends AbstractRoleEventTest
{
    /**
     * @inheritDoc
     */
    protected string $activeEventHandler = RoleCreated::class;

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfEventCanBeCreated(array $data): void
    {
        $this->assertInstanceOf(RoleCreated::class, $this->createClassInstance($data));
    }

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetIdMethod(array $data): void
    {
        $this->assertEquals(Arr::get($data, 'id'), $this->createClassInstance($data)->getID());
    }

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetNameMethod(array $data): void
    {
        $this->assertEquals(Arr::get($data, 'name'), $this->createClassInstance($data)->getName());
    }

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetDescriptionMethod(array $data): void
    {
        $this->assertEquals(Arr::get($data, 'description'), $this->createClassInstance($data)->getDescription());
    }

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetPoliciesMethod(array $data): void
    {
        $this->assertEquals(Arr::get($data, 'policies'), $this->createClassInstance($data)->getPolicies());
    }

    /**
     * @inheritDoc
     */
    protected function createClassInstance(array $data): RoleCreated
    {
        return new $this->activeEventHandler(
            Arr::get($data, 'id'),
            Arr::get($data, 'name'),
            Arr::get($data, 'description'),
            Arr::get($data, 'policies'),
            Arr::get($data, 'user')
        );
    }
}
