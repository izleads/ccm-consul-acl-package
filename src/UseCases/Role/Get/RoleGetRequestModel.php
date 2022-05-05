<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Get;

use Illuminate\Http\Request;

/**
 * Class RoleGetRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Get
 */
class RoleGetRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * Role ID
     * @var string
     */
    private string $roleID;

    /**
     * RoleGetRequestModel constructor.
     * @param Request $request
     * @param string $roleID
     */
    public function __construct(Request $request, string $roleID)
    {
        $this->request = $request;
        $this->roleID = $roleID;
    }

    /**
     * Get request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Get role id
     * @return string
     */
    public function getRoleID(): string
    {
        return $this->roleID;
    }
}
