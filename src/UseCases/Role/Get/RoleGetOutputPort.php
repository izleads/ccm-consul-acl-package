<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleGetOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Get
 */
interface RoleGetOutputPort
{
    /**
     * Output port for "get"
     * @param RoleGetResponseModel $responseModel
     * @return ViewModel
     */
    public function get(RoleGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param RoleGetResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(RoleGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param RoleGetResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(RoleGetResponseModel $responseModel, Throwable $exception): ViewModel;
}
