<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Token;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Create\TokenCreateOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Create\TokenCreateResponseModel;

/**
 * Class TokenCreateHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Token
 */
class TokenCreateHttpPresenter implements TokenCreateOutputPort
{
    /**
     * @inheritDoc
     */
    public function create(TokenCreateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity()->toArray(),
            'Successfully created new token',
            Response::HTTP_CREATED,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(TokenCreateResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to create new token'
        ));
    }
    // @codeCoverageIgnoreEnd
}
