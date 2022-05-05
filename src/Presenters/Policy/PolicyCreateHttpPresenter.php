<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Policy;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Create\PolicyCreateOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Create\PolicyCreateResponseModel;

/**
 * Class PolicyCreateHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Policy
 */
class PolicyCreateHttpPresenter implements PolicyCreateOutputPort
{
    /**
     * @inheritDoc
     */
    public function create(PolicyCreateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity()->toArray(),
            'Successfully created new policy',
            Response::HTTP_CREATED,
        ));
    }

    /**
     * @inheritDoc
     */
    public function alreadyExists(PolicyCreateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            [],
            'Policy with specified name already exists',
            Response::HTTP_CONFLICT,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(PolicyCreateResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to create new policy'
        ));
    }
    // @codeCoverageIgnoreEnd
}
