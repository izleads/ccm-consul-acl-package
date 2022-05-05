<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Update;

use ConsulConfigManager\Consul\ACL\Http\Requests\Role\RoleCreateUpdateRequest;

/**
 * Class RoleUpdateRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Update
 */
class RoleUpdateRequestModel
{
    /**
     * Request instance
     * @var RoleCreateUpdateRequest
     */
    private RoleCreateUpdateRequest $request;

    /**
     * Accessor ID
     * @var string
     */
    private string $accessor;

    /**
     * RoleUpdateRequestModel constructor.
     * @param RoleCreateUpdateRequest $request
     * @param string $accessorID
     */
    public function __construct(RoleCreateUpdateRequest $request, string $accessorID)
    {
        $this->request = $request;
        $this->accessor = $accessorID;
    }

    /**
     * Get request instance
     * @return RoleCreateUpdateRequest
     */
    public function getRequest(): RoleCreateUpdateRequest
    {
        return $this->request;
    }

    /**
     * Get accessor id
     * @return string
     */
    public function getAccessorID(): string
    {
        return $this->accessor;
    }
}
