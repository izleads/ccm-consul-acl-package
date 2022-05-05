<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Get;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleGetInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Get
 */
interface RoleGetInputPort
{
    /**
     * Retrieve role
     * @param RoleGetRequestModel $requestModel
     * @return ViewModel
     */
    public function get(RoleGetRequestModel $requestModel): ViewModel;
}
