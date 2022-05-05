<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Policy\List;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\List\PolicyListRequestModel;

/**
 * Class PolicyListRequestModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Policy\List
 */
class PolicyListRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new PolicyListRequestModel($request);
        $this->assertSame($request, $instance->getRequest());
    }
}
