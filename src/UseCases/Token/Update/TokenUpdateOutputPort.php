<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Update;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface TokenUpdateOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Update
 */
interface TokenUpdateOutputPort
{
    /**
     * Output port for "update"
     * @param TokenUpdateResponseModel $responseModel
     * @return ViewModel
     */
    public function update(TokenUpdateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param TokenUpdateResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(TokenUpdateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param TokenUpdateResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(TokenUpdateResponseModel $responseModel, Throwable $exception): ViewModel;
}
