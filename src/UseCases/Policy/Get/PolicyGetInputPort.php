<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Get;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PolicyGetInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Get
 */
interface PolicyGetInputPort
{
    /**
     * Retrieve policy
     * @param PolicyGetRequestModel $requestModel
     * @return ViewModel
     */
    public function get(PolicyGetRequestModel $requestModel): ViewModel;
}
