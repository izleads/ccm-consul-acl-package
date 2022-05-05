<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Policy;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete\PolicyDeleteInputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete\PolicyDeleteRequestModel;

/**
 * Class PolicyDeleteController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class PolicyDeleteController extends Controller
{
    /**
     * Input port interactor instance
     * @var PolicyDeleteInputPort
     */
    private PolicyDeleteInputPort $interactor;

    /**
     * PolicyDeleteController constructor.
     * @param PolicyDeleteInputPort $interactor
     * @return void
     */
    public function __construct(PolicyDeleteInputPort $interactor)
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
        $viewModel = $this->interactor->delete(
            new PolicyDeleteRequestModel($request, $policyID)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
