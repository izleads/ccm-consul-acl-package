<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Policy\Delete;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete\PolicyDeleteRequestModel;

/**
 * Class PolicyDeleteRequestModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Policy\Delete
 */
class PolicyDeleteRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new PolicyDeleteRequestModel($request, '123');
        $this->assertSame($request, $instance->getRequest());
    }
}
