<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Token;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Delete\TokenDeleteInputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Delete\TokenDeleteRequestModel;

/**
 * Class TokenDeleteController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class TokenDeleteController extends Controller
{
    /**
     * Input port interactor instance
     * @var TokenDeleteInputPort
     */
    private TokenDeleteInputPort $interactor;

    /**
     * TokenDeleteController constructor.
     * @param TokenDeleteInputPort $interactor
     * @return void
     */
    public function __construct(TokenDeleteInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param Request $request
     * @param string $tokenID
     * @return Response|null
     */
    public function __invoke(Request $request, string $tokenID): ?Response
    {
        $viewModel = $this->interactor->delete(
            new TokenDeleteRequestModel($request, $tokenID)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
