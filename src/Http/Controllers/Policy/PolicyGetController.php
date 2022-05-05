<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Policy;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Get\PolicyGetInputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Get\PolicyGetRequestModel;

/**
 * Class PolicyGetController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class PolicyGetController extends Controller
{
    /**
     * Input port interactor instance
     * @var PolicyGetInputPort
     */
    private PolicyGetInputPort $interactor;

    /**
     * PolicyGetController constructor.
     * @param PolicyGetInputPort $interactor
     * @return void
     */
    public function __construct(PolicyGetInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param Request $request
     * @param string $policyID
     * @return Response|null
     */
    public function __invoke(Request $request, string $policyID): ?Response
    {
        $viewModel = $this->interactor->get(
            new PolicyGetRequestModel($request, $policyID)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
