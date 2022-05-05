<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Token;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Get\TokenGetInputPort;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Get\TokenGetRequestModel;

/**
 * Class TokenGetController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class TokenGetController extends Controller
{
    /**
     * Input port interactor instance
     * @var TokenGetInputPort
     */
    private TokenGetInputPort $interactor;

    /**
     * TokenGetController constructor.
     * @param TokenGetInputPort $interactor
     * @return void
     */
    public function __construct(TokenGetInputPort $interactor)
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
        $viewModel = $this->interactor->get(
            new TokenGetRequestModel($request, $tokenID)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
