<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Role\List;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Role\List\RoleListRequestModel;

/**
 * Class RoleListRequestModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Role\List
 */
class RoleListRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new RoleListRequestModel($request);
        $this->assertSame($request, $instance->getRequest());
    }
}
