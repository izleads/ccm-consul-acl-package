<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Update;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PolicyUpdateInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Update
 */
interface PolicyUpdateInputPort
{
    /**
     * Update policy
     * @param PolicyUpdateRequestModel $requestModel
     * @return ViewModel
     */
    public function update(PolicyUpdateRequestModel $requestModel): ViewModel;
}
