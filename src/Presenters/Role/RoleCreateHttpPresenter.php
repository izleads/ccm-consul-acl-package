<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Role;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Create\RoleCreateOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Create\RoleCreateResponseModel;

/**
 * Class RoleCreateHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Role
 */
class RoleCreateHttpPresenter implements RoleCreateOutputPort
{
    /**
     * @inheritDoc
     */
    public function create(RoleCreateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getEntity()->toArray(),
            'Successfully created new role',
            Response::HTTP_CREATED,
        ));
    }

    /**
     * @inheritDoc
     */
    public function alreadyExists(RoleCreateResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_error(
            [],
            'Role with specified name already exists',
            Response::HTTP_CONFLICT,
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(RoleCreateResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to create new role'
        ));
    }
    // @codeCoverageIgnoreEnd
}
