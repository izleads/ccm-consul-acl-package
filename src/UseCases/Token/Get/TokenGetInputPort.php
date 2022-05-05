<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Get;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface TokenGetInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Get
 */
interface TokenGetInputPort
{
    /**
     * Retrieve token
     * @param TokenGetRequestModel $requestModel
     * @return ViewModel
     */
    public function get(TokenGetRequestModel $requestModel): ViewModel;
}
