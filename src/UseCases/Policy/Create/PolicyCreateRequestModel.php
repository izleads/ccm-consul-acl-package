<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Create;

use ConsulConfigManager\Consul\ACL\Http\Requests\Policy\PolicyCreateUpdateRequest;

/**
 * Class PolicyCreateRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Create
 */
class PolicyCreateRequestModel
{
    /**
     * Request instance
     * @var PolicyCreateUpdateRequest
     */
    private PolicyCreateUpdateRequest $request;

    /**
     * PolicyCreateRequestModel constructor.
     * @param PolicyCreateUpdateRequest $request
     * @return void
     */
    public function __construct(PolicyCreateUpdateRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Get request instance
     * @return PolicyCreateUpdateRequest
     */
    public function getRequest(): PolicyCreateUpdateRequest
    {
        return $this->request;
    }
}
