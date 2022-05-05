<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Role;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Create\RoleCreateInputPort;
use ConsulConfigManager\Consul\ACL\Http\Requests\Role\RoleCreateUpdateRequest;
use ConsulConfigManager\Consul\ACL\UseCases\Role\Create\RoleCreateRequestModel;

/**
 * Class RoleCreateController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class RoleCreateController extends Controller
{
    /**
     * Input port interactor instance
     * @var RoleCreateInputPort
     */
    private RoleCreateInputPort $interactor;

    /**
     * RoleCreateController constructor.
     * @param RoleCreateInputPort $interactor
     * @return void
     */
    public function __construct(RoleCreateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param RoleCreateUpdateRequest $request
     * @return Response|null
     */
    public function __invoke(RoleCreateUpdateRequest $request): ?Response
    {
        $viewModel = $this->interactor->create(
            new RoleCreateRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
