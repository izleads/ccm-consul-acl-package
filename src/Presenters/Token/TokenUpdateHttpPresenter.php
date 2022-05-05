<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Token;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Update\TokenUpdateOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Update\TokenUpdateResponseModel;

/**
 * Class TokenUpdateHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Token
 */
class TokenUpdateHttpPresenter implements TokenUpdateOutputPort
{
    /**
     * @inheritDoc
     */
    public function update(TokenUpdateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity()->toArray(),
            'Successfully updated token',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(TokenUpdateResponseModel $responseModel): ViewModel
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
    public function internalServerError(TokenUpdateResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to update token'
        ));
    }
    // @codeCoverageIgnoreEnd
}
