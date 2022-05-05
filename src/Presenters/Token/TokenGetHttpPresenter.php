<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Token;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Get\TokenGetOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Get\TokenGetResponseModel;

/**
 * Class TokenGetHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Token
 */
class TokenGetHttpPresenter implements TokenGetOutputPort
{
    /**
     * @inheritDoc
     */
    public function get(TokenGetResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity()->toArray(),
            'Successfully fetched token information',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(TokenGetResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            [],
            'Unable to find token',
            Response::HTTP_NOT_FOUND,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(TokenGetResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to retrieve token information'
        ));
    }
    // @codeCoverageIgnoreEnd
}
