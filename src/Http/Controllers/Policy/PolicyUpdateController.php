<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Policy;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Update\PolicyUpdateInputPort;
use ConsulConfigManager\Consul\ACL\Http\Requests\Policy\PolicyCreateUpdateRequest;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Update\PolicyUpdateRequestModel;

/**
 * Class PolicyUpdateController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class PolicyUpdateController extends Controller
{
    /**
     * Input port interactor instance
     * @var PolicyUpdateInputPort
     */
    private PolicyUpdateInputPort $interactor;

    /**
     * PolicyUpdateController constructor.
     * @param PolicyUpdateInputPort $interactor
     * @return void
     */
    public function __construct(PolicyUpdateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param PolicyCreateUpdateRequest $request
     * @param string $policyID
     * @return Response|null
     */
    public function __invoke(PolicyCreateUpdateRequest $request, string $policyID): ?Response
    {
        $viewModel = $this->interactor->update(
            new PolicyUpdateRequestModel($request, $policyID)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
