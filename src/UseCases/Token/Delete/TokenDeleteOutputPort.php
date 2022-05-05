<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface TokenDeleteOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Delete
 */
interface TokenDeleteOutputPort
{
    /**
     * Output port for "delete"
     * @param TokenDeleteResponseModel $responseModel
     * @return ViewModel
     */
    public function delete(TokenDeleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "not found"
     * @param TokenDeleteResponseModel $responseModel
     * @return ViewModel
     */
    public function notFound(TokenDeleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param TokenDeleteResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(TokenDeleteResponseModel $responseModel, Throwable $exception): ViewModel;
}
