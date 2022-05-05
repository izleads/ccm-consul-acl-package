<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PolicyDeleteInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete
 */
interface PolicyDeleteInputPort
{
    /**
     * Delete policy
     * @param PolicyDeleteRequestModel $requestModel
     * @return ViewModel
     */
    public function delete(PolicyDeleteRequestModel $requestModel): ViewModel;
}
