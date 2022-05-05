<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Token\List;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Token\List\TokenListRequestModel;

/**
 * Class TokenListRequestModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Token\List
 */
class TokenListRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new TokenListRequestModel($request);
        $this->assertSame($request, $instance->getRequest());
    }
}
