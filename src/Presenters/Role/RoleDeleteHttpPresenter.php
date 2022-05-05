<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Role;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Delete\RoleDeleteOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Delete\RoleDeleteResponseModel;

/**
 * Class RoleDeleteHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Role
 */
class RoleDeleteHttpPresenter implements RoleDeleteOutputPort
{
    /**
     * @inheritDoc
     */
    public function delete(RoleDeleteResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            [],
            'Successfully deleted role',
            Response::HTTP_OK,
        ));
    }

    /**
     * @inheritDoc
     */
    public function notFound(RoleDeleteResponseModel $responseModel): ViewModel
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
    public function internalServerError(RoleDeleteResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to delete role'
        ));
    }
    // @codeCoverageIgnoreEnd
}
