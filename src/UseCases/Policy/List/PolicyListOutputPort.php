<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PolicyListOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\List
 */
interface PolicyListOutputPort
{
    /**
     * Output port for "list"
     * @param PolicyListResponseModel $responseModel
     * @return ViewModel
     */
    public function list(PolicyListResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param PolicyListResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(PolicyListResponseModel $responseModel, Throwable $exception): ViewModel;
}
