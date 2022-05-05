<?php

namespace ConsulConfigManager\Consul\ACL\Presenters\Policy;

use Throwable;
use Illuminate\Http\Response;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete\PolicyAutocompleteOutputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete\PolicyAutocompleteResponseModel;

/**
 * Class PolicyAutocompleteHttpPresenter
 * @package ConsulConfigManager\Consul\ACL\Presenters\Policy
 */
class PolicyAutocompleteHttpPresenter implements PolicyAutocompleteOutputPort
{
    /**
     * @inheritDoc
     */
    public function autocomplete(PolicyAutocompleteResponseModel $responseModel): ViewModel
    {
        return new HttpResponseViewModel(response_success(
            $responseModel->getPolicies(),
            'Successfully fetched list of policies for autocompletion',
            Response::HTTP_OK
        ));
    }

    // @codeCoverageIgnoreStart
    /**
     * @inheritDoc
     */
    public function internalServerError(PolicyAutocompleteResponseModel $responseModel, Throwable $exception): ViewModel
    {
        if (config('app.debug')) {
            throw $exception;
        }

        return new HttpResponseViewModel(response_error(
            $exception,
            'Unable to retrieve policies list for autocompletion'
        ));
    }
    // @codeCoverageIgnoreEnd
}
