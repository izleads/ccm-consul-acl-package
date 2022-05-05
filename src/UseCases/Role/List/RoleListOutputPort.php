<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleListOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\List
 */
interface RoleListOutputPort
{
    /**
     * Output port for "list"
     * @param RoleListResponseModel $responseModel
     * @return ViewModel
     */
    public function list(RoleListResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param RoleListResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(RoleListResponseModel $responseModel, Throwable $exception): ViewModel;
}
