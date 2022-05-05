<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Policy;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete\PolicyAutocompleteInputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete\PolicyAutocompleteRequestModel;

/**
 * Class PolicyAutocompleteController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class PolicyAutocompleteController extends Controller
{
    /**
     * Input port interactor instance
     * @var PolicyAutocompleteInputPort
     */
    private PolicyAutocompleteInputPort $interactor;

    /**
     * PolicyAutocompleteController constructor.
     * @param PolicyAutocompleteInputPort $interactor
     * @return void
     */
    public function __construct(PolicyAutocompleteInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param Request $request
     * @return Response|null
     */
    public function __invoke(Request $request): ?Response
    {
        $viewModel = $this->interactor->autocomplete(
            new PolicyAutocompleteRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
