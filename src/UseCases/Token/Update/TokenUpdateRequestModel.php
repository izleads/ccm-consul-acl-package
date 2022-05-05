<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Update;

use ConsulConfigManager\Consul\ACL\Http\Requests\Token\TokenCreateUpdateRequest;

/**
 * Class TokenUpdateRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Update
 */
class TokenUpdateRequestModel
{
    /**
     * Request instance
     * @var TokenCreateUpdateRequest
     */
    private TokenCreateUpdateRequest $request;

    /**
     * Accessor ID
     * @var string
     */
    private string $accessor;

    /**
     * TokenUpdateRequestModel constructor.
     * @param TokenCreateUpdateRequest $request
     * @param string $accessorID
     */
    public function __construct(TokenCreateUpdateRequest $request, string $accessorID)
    {
        $this->request = $request;
        $this->accessor = $accessorID;
    }

    /**
     * Get request instance
     * @return TokenCreateUpdateRequest
     */
    public function getRequest(): TokenCreateUpdateRequest
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
