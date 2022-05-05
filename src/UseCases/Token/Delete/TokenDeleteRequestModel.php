<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Delete;

use Illuminate\Http\Request;

/**
 * Class TokenDeleteRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Delete
 */
class TokenDeleteRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * Token ID
     * @var string
     */
    private string $accessorID;

    /**
     * TokenDeleteRequestModel constructor.
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
     * Delete token id
     * @return string
     */
    public function getAccessorID(): string
    {
        return $this->accessorID;
    }
}
