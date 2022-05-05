<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Update;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleUpdateInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Update
 */
interface RoleUpdateInputPort
{
    /**
     * Update role
     * @param RoleUpdateRequestModel $requestModel
     * @return ViewModel
     */
    public function update(RoleUpdateRequestModel $requestModel): ViewModel;
}
