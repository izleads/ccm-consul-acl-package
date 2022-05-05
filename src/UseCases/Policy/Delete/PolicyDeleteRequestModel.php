<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete;

use Illuminate\Http\Request;

/**
 * Class PolicyDeleteRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete
 */
class PolicyDeleteRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * Policy ID
     * @var string
     */
    private string $accessorID;

    /**
     * PolicyDeleteRequestModel constructor.
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
     * Delete policy id
     * @return string
     */
    public function getAccessorID(): string
    {
        return $this->accessorID;
    }
}
