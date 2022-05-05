<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Policy\Autocomplete;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete\PolicyAutocompleteRequestModel;

/**
 * Class PolicyAutocompleteRequestModelTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\UseCases\Policy\Autocomplete
 */
class PolicyAutocompleteRequestModelTest extends TestCase
{
    /**
     * @return void
     */
    public function testShouldPassIfInstanceOfRequestIsReturned(): void
    {
        $request = request();
        $instance = new PolicyAutocompleteRequestModel($request);
        $this->assertSame($request, $instance->getRequest());
    }
}
