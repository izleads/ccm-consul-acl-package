<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Create;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface TokenCreateInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Create
 */
interface TokenCreateInputPort
{
    /**
     * Create token
     * @param TokenCreateRequestModel $requestModel
     * @return ViewModel
     */
    public function create(TokenCreateRequestModel $requestModel): ViewModel;
}
