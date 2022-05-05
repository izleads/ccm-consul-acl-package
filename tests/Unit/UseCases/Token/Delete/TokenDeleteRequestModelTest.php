<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Token\Delete;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Delete\TokenDeleteRequestModel;

/**
 * Class TokenDeleteRequestModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Token\Delete
 */
class TokenDeleteRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new TokenDeleteRequestModel($request, '123');
        $this->assertSame($request, $instance->getRequest());
    }
}
