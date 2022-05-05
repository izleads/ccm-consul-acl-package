<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Policy;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\List\PolicyListOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\List\PolicyListResponseModel;

/**
 * Class PolicyListHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Policy
 */
class PolicyListHttpPresenter implements PolicyListOutputPort
{
    /**
     * @inheritDoc
     */
    public function list(PolicyListResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getPolicies(),
            'Successfully fetched list of policies',
            Response::HTTP_OK
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(PolicyListResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to retrieve policies list'
        ));
    }
    // @codeCoverageIgnoreEnd
}
