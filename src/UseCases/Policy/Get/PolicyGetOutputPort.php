<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PolicyGetOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Get
 */
interface PolicyGetOutputPort
{
    /**
     * Output port for "get"
     * @param PolicyGetResponseModel $responseModel
     * @return ViewModel
     */
    public function get(PolicyGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param PolicyGetResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(PolicyGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param PolicyGetResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(PolicyGetResponseModel $responseModel, Throwable $exception): ViewModel;
}
