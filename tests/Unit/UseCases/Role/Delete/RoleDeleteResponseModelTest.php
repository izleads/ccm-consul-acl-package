<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Role\Delete;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Delete\RoleDeleteResponseModel;

/**
 * Class RoleDeleteResponseModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Role\Delete
 */
class RoleDeleteResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfNullIsReturned(): void
    {
        $instance = new RoleDeleteResponseModel();
        $this->assertNull($instance->getEntity());
    }
}
