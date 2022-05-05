<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Role\Get;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Get\RoleGetRequestModel;

/**
 * Class RoleGetRequestModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Role\Get
 */
class RoleGetRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new RoleGetRequestModel($request, '123');
        $this->assertSame($request, $instance->getRequest());
    }
}
