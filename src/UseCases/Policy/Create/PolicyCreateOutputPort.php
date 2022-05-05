<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Create;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PolicyCreateOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Create
 */
interface PolicyCreateOutputPort
{
    /**
     * Output port for "create"
     * @param PolicyCreateResponseModel $responseModel
     * @return ViewModel
     */
    public function create(PolicyCreateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "already exists"
     * @param PolicyCreateResponseModel $responseModel
     * @return ViewModel
     */
    public function alreadyExists(PolicyCreateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param PolicyCreateResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(PolicyCreateResponseModel $responseModel, Throwable $exception): ViewModel;
}
