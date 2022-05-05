<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Role;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Update\RoleUpdateOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Update\RoleUpdateResponseModel;

/**
 * Class RoleUpdateHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Role
 */
class RoleUpdateHttpPresenter implements RoleUpdateOutputPort
{
    /**
     * @inheritDoc
     */
    public function update(RoleUpdateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity()->toArray(),
            'Successfully updated role',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(RoleUpdateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            [],
            'Unable to find requested role',
            Response::HTTP_NOT_FOUND,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(RoleUpdateResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to update role'
        ));
    }
    // @codeCoverageIgnoreEnd
}
