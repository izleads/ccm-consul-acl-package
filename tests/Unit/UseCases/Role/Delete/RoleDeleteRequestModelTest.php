<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Role\Delete;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Delete\RoleDeleteRequestModel;

/**
 * Class RoleDeleteRequestModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Role\Delete
 */
class RoleDeleteRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new RoleDeleteRequestModel($request, '123');
        $this->assertSame($request, $instance->getRequest());
    }
}
