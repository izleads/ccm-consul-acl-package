<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Policy\Get;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Get\PolicyGetRequestModel;

/**
 * Class PolicyGetRequestModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Policy\Get
 */
class PolicyGetRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new PolicyGetRequestModel($request, '123');
        $this->assertSame($request, $instance->getRequest());
    }
}
