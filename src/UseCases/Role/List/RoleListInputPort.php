<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\List;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleListInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\List
 */
interface RoleListInputPort
{
    /**
     * Get list of all ACL roles
     * @param RoleListRequestModel $requestModel
     * @return ViewModel
     */
    public function list(RoleListRequestModel $requestModel): ViewModel;
}
