<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Update;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PolicyUpdateOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Update
 */
interface PolicyUpdateOutputPort
{
    /**
     * Output port for "update"
     * @param PolicyUpdateResponseModel $responseModel
     * @return ViewModel
     */
    public function update(PolicyUpdateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param PolicyUpdateResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(PolicyUpdateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param PolicyUpdateResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(PolicyUpdateResponseModel $responseModel, Throwable $exception): ViewModel;
}
