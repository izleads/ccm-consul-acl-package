<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface TokenListOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\List
 */
interface TokenListOutputPort
{
    /**
     * Output port for "list"
     * @param TokenListResponseModel $responseModel
     * @return ViewModel
     */
    public function list(TokenListResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param TokenListResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(TokenListResponseModel $responseModel, Throwable $exception): ViewModel;
}
