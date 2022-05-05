<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Policy\Delete;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete\PolicyDeleteResponseModel;

/**
 * Class PolicyDeleteResponseModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Policy\Delete
 */
class PolicyDeleteResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfNullIsReturned(): void
    {
        $instance = new PolicyDeleteResponseModel();
        $this->assertNull($instance->getEntity());
    }
}
