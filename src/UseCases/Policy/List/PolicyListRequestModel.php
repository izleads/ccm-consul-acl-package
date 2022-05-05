<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\List;

use Illuminate\Http\Request;

/**
 * Class PolicyListRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\List
 */
class PolicyListRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * PolicyListRequestModel constructor.
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
