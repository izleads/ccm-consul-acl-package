<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface TokenGetOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Get
 */
interface TokenGetOutputPort
{
    /**
     * Output port for "get"
     * @param TokenGetResponseModel $responseModel
     * @return ViewModel
     */
    public function get(TokenGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param TokenGetResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(TokenGetResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param TokenGetResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(TokenGetResponseModel $responseModel, Throwable $exception): ViewModel;
}
