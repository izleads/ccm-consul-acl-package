<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleDeleteOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Delete
 */
interface RoleDeleteOutputPort
{
    /**
     * Output port for "delete"
     * @param RoleDeleteResponseModel $responseModel
     * @return ViewModel
     */
    public function delete(RoleDeleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param RoleDeleteResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(RoleDeleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param RoleDeleteResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(RoleDeleteResponseModel $responseModel, Throwable $exception): ViewModel;
}
