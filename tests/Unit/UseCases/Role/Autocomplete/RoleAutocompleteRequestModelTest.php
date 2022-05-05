<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Role\Autocomplete;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete\RoleAutocompleteRequestModel;

/**
 * Class RoleAutocompleteRequestModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Role\Autocomplete
 */
class RoleAutocompleteRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new RoleAutocompleteRequestModel($request);
        $this->assertSame($request, $instance->getRequest());
    }
}
