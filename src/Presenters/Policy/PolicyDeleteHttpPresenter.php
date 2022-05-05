<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Policy;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete\PolicyDeleteOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete\PolicyDeleteResponseModel;

/**
 * Class PolicyDeleteHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Policy
 */
class PolicyDeleteHttpPresenter implements PolicyDeleteOutputPort
{
    /**
     * @inheritDoc
     */
    public function delete(PolicyDeleteResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            [],
            'Successfully deleted policy',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(PolicyDeleteResponseModel $responseModel): ViewModel
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
    public function internalServerError(PolicyDeleteResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to delete policy'
        ));
    }
    // @codeCoverageIgnoreEnd
}
