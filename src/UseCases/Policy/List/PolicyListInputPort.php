<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\List;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PolicyListInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\List
 */
interface PolicyListInputPort
{
    /**
     * Get list of all ACL policies
     * @param PolicyListRequestModel $requestModel
     * @return ViewModel
     */
    public function list(PolicyListRequestModel $requestModel): ViewModel;
}
