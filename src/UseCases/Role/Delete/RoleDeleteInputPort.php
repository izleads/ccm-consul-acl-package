<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Delete;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleDeleteInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Delete
 */
interface RoleDeleteInputPort
{
    /**
     * Delete role
     * @param RoleDeleteRequestModel $requestModel
     * @return ViewModel
     */
    public function delete(RoleDeleteRequestModel $requestModel): ViewModel;
}
