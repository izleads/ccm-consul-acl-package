<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Role;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete\RoleAutocompleteInputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete\RoleAutocompleteRequestModel;

/**
 * Class RoleAutocompleteController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class RoleAutocompleteController extends Controller
{
    /**
     * Input port interactor instance
     * @var RoleAutocompleteInputPort
     */
    private RoleAutocompleteInputPort $interactor;

    /**
     * RoleAutocompleteController constructor.
     * @param RoleAutocompleteInputPort $interactor
     * @return void
     */
    public function __construct(RoleAutocompleteInputPort $interactor)
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
            new RoleAutocompleteRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
