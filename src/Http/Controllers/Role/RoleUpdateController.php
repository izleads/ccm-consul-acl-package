<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Role;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Update\RoleUpdateInputPort;
use ConsulConfigManager\Consul\ACL\Http\Requests\Role\RoleCreateUpdateRequest;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Update\RoleUpdateRequestModel;

/**
 * Class RoleUpdateController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class RoleUpdateController extends Controller
{
    /**
     * Input port interactor instance
     * @var RoleUpdateInputPort
     */
    private RoleUpdateInputPort $interactor;

    /**
     * RoleUpdateController constructor.
     * @param RoleUpdateInputPort $interactor
     * @return void
     */
    public function __construct(RoleUpdateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param RoleCreateUpdateRequest $request
     * @param string $roleID
     * @return Response|null
     */
    public function __invoke(RoleCreateUpdateRequest $request, string $roleID): ?Response
    {
        $viewModel = $this->interactor->update(
            new RoleUpdateRequestModel($request, $roleID)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
