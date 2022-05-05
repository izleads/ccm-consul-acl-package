<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Policy;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\List\PolicyListInputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\List\PolicyListRequestModel;

/**
 * Class PolicyListController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class PolicyListController extends Controller
{
    /**
     * Input port interactor instance
     * @var PolicyListInputPort
     */
    private PolicyListInputPort $interactor;

    /**
     * PolicyListController constructor.
     * @param PolicyListInputPort $interactor
     * @return void
     */
    public function __construct(PolicyListInputPort $interactor)
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
        $viewModel = $this->interactor->list(
            new PolicyListRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
