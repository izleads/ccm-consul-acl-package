<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Token\Delete;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Delete\TokenDeleteResponseModel;

/**
 * Class TokenDeleteResponseModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Token\Delete
 */
class TokenDeleteResponseModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfNullIsReturned(): void
    {
        $instance = new TokenDeleteResponseModel();
        $this->assertNull($instance->getEntity());
    }
}
