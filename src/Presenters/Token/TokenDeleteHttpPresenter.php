<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Token;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Delete\TokenDeleteOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Delete\TokenDeleteResponseModel;

/**
 * Class TokenDeleteHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Token
 */
class TokenDeleteHttpPresenter implements TokenDeleteOutputPort
{
    /**
     * @inheritDoc
     */
    public function delete(TokenDeleteResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            [],
            'Successfully deleted token',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(TokenDeleteResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            [],
            'Unable to find requested token',
            Response::HTTP_NOT_FOUND,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(TokenDeleteResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to delete token'
        ));
    }
    // @codeCoverageIgnoreEnd
}
