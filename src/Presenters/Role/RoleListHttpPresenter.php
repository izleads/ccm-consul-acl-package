<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Role;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Role\List\RoleListOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Role\List\RoleListResponseModel;

/**
 * Class RoleListHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Role
 */
class RoleListHttpPresenter implements RoleListOutputPort
{
    /**
     * @inheritDoc
     */
    public function list(RoleListResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getRoles(),
            'Successfully fetched list of roles',
            Response::HTTP_OK
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(RoleListResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to retrieve roles list'
        ));
    }
    // @codeCoverageIgnoreEnd
}
