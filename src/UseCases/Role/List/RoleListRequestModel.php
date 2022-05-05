<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\List;

use Illuminate\Http\Request;

/**
 * Class RoleListRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\List
 */
class RoleListRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * RoleListRequestModel constructor.
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
