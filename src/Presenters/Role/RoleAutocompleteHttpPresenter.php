<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Role;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete\RoleAutocompleteOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete\RoleAutocompleteResponseModel;

/**
 * Class RoleAutocompleteHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Role
 */
class RoleAutocompleteHttpPresenter implements RoleAutocompleteOutputPort
{
    /**
     * @inheritDoc
     */
    public function autocomplete(RoleAutocompleteResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getRoles(),
            'Successfully fetched list of roles for autocompletion',
            Response::HTTP_OK
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(RoleAutocompleteResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to retrieve roles list for autocompletion'
        ));
    }
    // @codeCoverageIgnoreEnd
}
