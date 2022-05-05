<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Policy;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Create\PolicyCreateInputPort;
use ConsulConfigManager\Consul\ACL\Http\Requests\Policy\PolicyCreateUpdateRequest;
use ConsulConfigManager\Consul\ACL\UseCases\Policy\Create\PolicyCreateRequestModel;

/**
 * Class PolicyCreateController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class PolicyCreateController extends Controller
{
    /**
     * Input port interactor instance
     * @var PolicyCreateInputPort
     */
    private PolicyCreateInputPort $interactor;

    /**
     * PolicyCreateController constructor.
     * @param PolicyCreateInputPort $interactor
     * @return void
     */
    public function __construct(PolicyCreateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param PolicyCreateUpdateRequest $request
     * @return Response|null
     */
    public function __invoke(PolicyCreateUpdateRequest $request): ?Response
    {
        $viewModel = $this->interactor->create(
            new PolicyCreateRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
