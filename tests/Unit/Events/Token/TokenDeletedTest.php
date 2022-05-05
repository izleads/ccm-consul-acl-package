<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\Events\Token;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\ACL\Events\Token\TokenDeleted;

/**
 * Class TokenDeletedTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\Events\Token
 */
class TokenDeletedTest extends AbstractTokenEventTest
{
    /**
     * @inheritDoc
     */
    protected string $activeEventHandler = TokenDeleted::class;

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfEventCanBeCreated(array $data): void
    {
        $this->assertInstanceOf(TokenDeleted::class, $this->createClassInstance($data));
    }

    /**
     * @inheritDoc
     */
    protected function createClassInstance(array $data): TokenDeleted
    {
        return new $this->activeEventHandler(
            Arr::get($data, 'user')
        );
    }
}
