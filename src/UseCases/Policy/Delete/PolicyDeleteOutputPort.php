<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PolicyDeleteOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete
 */
interface PolicyDeleteOutputPort
{
    /**
     * Output port for "delete"
     * @param PolicyDeleteResponseModel $responseModel
     * @return ViewModel
     */
    public function delete(PolicyDeleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param PolicyDeleteResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(PolicyDeleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param PolicyDeleteResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(PolicyDeleteResponseModel $responseModel, Throwable $exception): ViewModel;
}
