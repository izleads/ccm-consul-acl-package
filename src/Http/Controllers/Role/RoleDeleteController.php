<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Role;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Delete\RoleDeleteInputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Delete\RoleDeleteRequestModel;

/**
 * Class RoleDeleteController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class RoleDeleteController extends Controller
{
    /**
     * Input port interactor instance
     * @var RoleDeleteInputPort
     */
    private RoleDeleteInputPort $interactor;

    /**
     * RoleDeleteController constructor.
     * @param RoleDeleteInputPort $interactor
     * @return void
     */
    public function __construct(RoleDeleteInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param Request $request
     * @param string $roleID
     * @return Response|null
     */
    public function __invoke(Request $request, string $roleID): ?Response
    {
        $viewModel = $this->interactor->delete(
            new RoleDeleteRequestModel($request, $roleID)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
