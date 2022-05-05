<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Update;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface TokenUpdateInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Update
 */
interface TokenUpdateInputPort
{
    /**
     * Update token
     * @param TokenUpdateRequestModel $requestModel
     * @return ViewModel
     */
    public function update(TokenUpdateRequestModel $requestModel): ViewModel;
}
