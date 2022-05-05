<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Create;

use ConsulConfigManager\Consul\ACL\Http\Requests\Token\TokenCreateUpdateRequest;

/**
 * Class TokenCreateRequestModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Create
 */
class TokenCreateRequestModel
{
    /**
     * Request instance
     * @var TokenCreateUpdateRequest
     */
    private TokenCreateUpdateRequest $request;

    /**
     * TokenCreateRequestModel constructor.
     * @param TokenCreateUpdateRequest $request
     * @return void
     */
    public function __construct(TokenCreateUpdateRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Get request instance
     * @return TokenCreateUpdateRequest
     */
    public function getRequest(): TokenCreateUpdateRequest
    {
        return $this->request;
    }
}
