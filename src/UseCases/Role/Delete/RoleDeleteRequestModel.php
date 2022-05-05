<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Delete;

use Illuminate\Http\Request;

/**
 * Class RoleDeleteRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Delete
 */
class RoleDeleteRequestModel
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
    private string $accessorID;

    /**
     * RoleDeleteRequestModel constructor.
     * @param Request $request
     * @param string $accessorID
     */
    public function __construct(Request $request, string $accessorID)
    {
        $this->request = $request;
        $this->accessorID = $accessorID;
    }

    /**
     * Delete request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Delete role id
     * @return string
     */
    public function getAccessorID(): string
    {
        return $this->accessorID;
    }
}
