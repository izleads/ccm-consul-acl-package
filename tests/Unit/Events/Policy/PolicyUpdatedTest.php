<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\Events\Policy;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\ACL\Events\Policy\PolicyUpdated;

/**
 * Class PolicyUpdatedTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\Events\Policy
 */
class PolicyUpdatedTest extends AbstractPolicyEventTest
{
    /**
     * @inheritDoc
     */
    protected string $activeEventHandler = PolicyUpdated::class;

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfEventCanBeCreated(array $data): void
    {
        $this->assertInstanceOf(PolicyUpdated::class, $this->createClassInstance($data));
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
    protected function createClassInstance(array $data): PolicyUpdated
    {
        return new $this->activeEventHandler(
            Arr::get($data, 'name'),
            Arr::get($data, 'description'),
            Arr::get($data, 'rules'),
            Arr::get($data, 'user')
        );
    }
}
