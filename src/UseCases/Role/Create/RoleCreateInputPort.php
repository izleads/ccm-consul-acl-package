<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Create;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleCreateInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Create
 */
interface RoleCreateInputPort
{
    /**
     * Create role
     * @param RoleCreateRequestModel $requestModel
     * @return ViewModel
     */
    public function create(RoleCreateRequestModel $requestModel): ViewModel;
}
