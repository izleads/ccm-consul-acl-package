<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Create;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PolicyCreateInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Create
 */
interface PolicyCreateInputPort
{
    /**
     * Create policy
     * @param PolicyCreateRequestModel $requestModel
     * @return ViewModel
     */
    public function create(PolicyCreateRequestModel $requestModel): ViewModel;
}
