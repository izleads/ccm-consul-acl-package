<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete;

use Illuminate\Http\Request;

/**
 * Class RoleAutocompleteRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete
 */
class RoleAutocompleteRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * RoleAutocompleteRequestModel constructor.
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
