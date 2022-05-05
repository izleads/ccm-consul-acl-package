<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Token;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Token\List\TokenListOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Token\List\TokenListResponseModel;

/**
 * Class TokenListHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Token
 */
class TokenListHttpPresenter implements TokenListOutputPort
{
    /**
     * @inheritDoc
     */
    public function list(TokenListResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getTokens(),
            'Successfully fetched list of tokens',
            Response::HTTP_OK
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(TokenListResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to retrieve tokens list'
        ));
    }
    // @codeCoverageIgnoreEnd
}
