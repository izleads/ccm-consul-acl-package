<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Token\Get;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Get\TokenGetRequestModel;

/**
 * Class TokenGetRequestModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Token\Get
 */
class TokenGetRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new TokenGetRequestModel($request, '123');
        $this->assertSame($request, $instance->getRequest());
    }
}
