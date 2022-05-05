<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Create;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface TokenCreateOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Create
 */
interface TokenCreateOutputPort
{
    /**
     * Output port for "create"
     * @param TokenCreateResponseModel $responseModel
     * @return ViewModel
     */
    public function create(TokenCreateResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param TokenCreateResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(TokenCreateResponseModel $responseModel, Throwable $exception): ViewModel;
}
