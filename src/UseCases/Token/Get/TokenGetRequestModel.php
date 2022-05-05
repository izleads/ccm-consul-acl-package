<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Get;

use Illuminate\Http\Request;

/**
 * Class TokenGetRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Get
 */
class TokenGetRequestModel
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
    private string $tokenID;

    /**
     * TokenGetRequestModel constructor.
     * @param Request $request
     * @param string $tokenID
     */
    public function __construct(Request $request, string $tokenID)
    {
        $this->request = $request;
        $this->tokenID = $tokenID;
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
     * Get token id
     * @return string
     */
    public function getTokenID(): string
    {
        return $this->tokenID;
    }
}
