<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\Events\Policy;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\ACL\Events\Policy\PolicyCreated;

/**
 * Class PolicyCreatedTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\Events\Policy
 */
class PolicyCreatedTest extends AbstractPolicyEventTest
{
    /**
     * @inheritDoc
     */
    protected string $activeEventHandler = PolicyCreated::class;

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfEventCanBeCreated(array $data): void
    {
        $this->assertInstanceOf(PolicyCreated::class, $this->createClassInstance($data));
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
    public function testShouldPassIfValidDataReturnedFromGetRulesMethod(array $data): void
    {
        $this->assertEquals(Arr::get($data, 'rules'), $this->createClassInstance($data)->getRules());
    }

    /**
     * @inheritDoc
     */
    protected function createClassInstance(array $data): PolicyCreated
    {
        return new $this->activeEventHandler(
            Arr::get($data, 'id'),
            Arr::get($data, 'name'),
            Arr::get($data, 'description'),
            Arr::get($data, 'rules'),
            Arr::get($data, 'user')
        );
    }
}
