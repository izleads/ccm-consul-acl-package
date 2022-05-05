<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete;

use Illuminate\Http\Request;

/**
 * Class PolicyAutocompleteRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete
 */
class PolicyAutocompleteRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * PolicyAutocompleteRequestModel constructor.
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }
}
