<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\List;

use Illuminate\Http\Request;

/**
 * Class TokenListRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\List
 */
class TokenListRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * TokenListRequestModel constructor.
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
