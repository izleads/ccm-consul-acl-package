<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\Events\Policy;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\ACL\Events\Policy\PolicyDeleted;

/**
 * Class PolicyDeletedTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\Events\Policy
 */
class PolicyDeletedTest extends AbstractPolicyEventTest
{
    /**
     * @inheritDoc
     */
    protected string $activeEventHandler = PolicyDeleted::class;

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     */
    public function testShouldPassIfEventCanBeCreated(array $data): void
    {
        $this->assertInstanceOf(PolicyDeleted::class, $this->createClassInstance($data));
    }

    /**
     * @inheritDoc
     */
    protected function createClassInstance(array $data): PolicyDeleted
    {
        return new $this->activeEventHandler(
            Arr::get($data, 'user')
        );
    }
}
