<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Token;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Update\TokenUpdateInputPort;
use ConsulConfigManager\Consul\ACL\Http\Requests\Token\TokenCreateUpdateRequest;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Update\TokenUpdateRequestModel;

/**
 * Class TokenUpdateController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class TokenUpdateController extends Controller
{
    /**
     * Input port interactor instance
     * @var TokenUpdateInputPort
     */
    private TokenUpdateInputPort $interactor;

    /**
     * TokenUpdateController constructor.
     * @param TokenUpdateInputPort $interactor
     * @return void
     */
    public function __construct(TokenUpdateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param TokenCreateUpdateRequest $request
     * @param string $tokenID
     * @return Response|null
     */
    public function __invoke(TokenCreateUpdateRequest $request, string $tokenID): ?Response
    {
        $viewModel = $this->interactor->update(
            new TokenUpdateRequestModel($request, $tokenID)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
