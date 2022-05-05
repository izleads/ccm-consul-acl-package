<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Policy;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Update\PolicyUpdateOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Update\PolicyUpdateResponseModel;

/**
 * Class PolicyUpdateHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Policy
 */
class PolicyUpdateHttpPresenter implements PolicyUpdateOutputPort
{
    /**
     * @inheritDoc
     */
    public function update(PolicyUpdateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity()->toArray(),
            'Successfully updated policy',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(PolicyUpdateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            [],
            'Unable to find requested policy',
            Response::HTTP_NOT_FOUND,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(PolicyUpdateResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to update policy'
        ));
    }
    // @codeCoverageIgnoreEnd
}
