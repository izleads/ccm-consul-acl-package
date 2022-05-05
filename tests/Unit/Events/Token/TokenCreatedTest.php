<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\Events\Token;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\ACL\Events\Token\TokenCreated;

/**
 * Class TokenCreatedTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\Events\Token
 */
class TokenCreatedTest extends AbstractTokenEventTest
{
    /**
     * @inheritDoc
     */
    protected string $activeEventHandler = TokenCreated::class;

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfEventCanBeCreated(array $data): void
    {
        $this->assertInstanceOf(TokenCreated::class, $this->createClassInstance($data));
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
    public function testShouldPassIfValidDataReturnedFromGetSecretMethod(array $data): void
    {
        $this->assertEquals(Arr::get($data, 'secret'), $this->createClassInstance($data)->getSecret());
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
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfValidDataReturnedFromGetRolesMethod(array $data): void
    {
        $this->assertEquals(Arr::get($data, 'roles'), $this->createClassInstance($data)->getRoles());
    }

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfValidDataReturnedFromIsLocalMethod(array $data): void
    {
        $this->assertEquals(Arr::get($data, 'local'), $this->createClassInstance($data)->isLocal());
    }

    /**
     * @inheritDoc
     */
    protected function createClassInstance(array $data): TokenCreated
    {
        return new $this->activeEventHandler(
            Arr::get($data, 'id'),
            Arr::get($data, 'secret'),
            Arr::get($data, 'description'),
            Arr::get($data, 'policies'),
            Arr::get($data, 'roles'),
            Arr::get($data, 'local'),
            Arr::get($data, 'user')
        );
    }
}
