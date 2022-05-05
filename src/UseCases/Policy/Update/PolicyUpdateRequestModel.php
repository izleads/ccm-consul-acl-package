<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Update;

use ConsulConfigManager\Consul\ACL\Http\Requests\Policy\PolicyCreateUpdateRequest;

/**
 * Class PolicyUpdateRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Update
 */
class PolicyUpdateRequestModel
{
    /**
     * Request instance
     * @var PolicyCreateUpdateRequest
     */
    private PolicyCreateUpdateRequest $request;

    /**
     * Accessor ID
     * @var string
     */
    private string $accessor;

    /**
     * PolicyUpdateRequestModel constructor.
     * @param PolicyCreateUpdateRequest $request
     * @param string $accessorID
     */
    public function __construct(PolicyCreateUpdateRequest $request, string $accessorID)
    {
        $this->request = $request;
        $this->accessor = $accessorID;
    }

    /**
     * Get request instance
     * @return PolicyCreateUpdateRequest
     */
    public function getRequest(): PolicyCreateUpdateRequest
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
