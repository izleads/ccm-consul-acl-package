<?php

namespace ConsulConfigManager\Consul\ACL\Http\Controllers\Token;

use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Create\TokenCreateInputPort;
use ConsulConfigManager\Consul\ACL\Http\Requests\Token\TokenCreateUpdateRequest;
use ConsulConfigManager\Consul\ACL\UseCases\Token\Create\TokenCreateRequestModel;

/**
 * Class TokenCreateController
 * @package ConsulConfigManager\Consul\Http\Controllers
 */
class TokenCreateController extends Controller
{
    /**
     * Input port interactor instance
     * @var TokenCreateInputPort
     */
    private TokenCreateInputPort $interactor;

    /**
     * TokenCreateController constructor.
     * @param TokenCreateInputPort $interactor
     * @return void
     */
    public function __construct(TokenCreateInputPort $interactor)
    {
        $this->interactor = $interactor;
    }

    // @codeCoverageIgnoreStart

    /**
     * Handle incoming request
     * @param TokenCreateUpdateRequest $request
     * @return Response|null
     */
    public function __invoke(TokenCreateUpdateRequest $request): ?Response
    {
        $viewModel = $this->interactor->create(
            new TokenCreateRequestModel($request)
        );

        if ($viewModel instanceof HttpResponseViewModel) {
            return $viewModel->getResponse();
        }

        return null;
    }

    // @codeCoverageIgnoreEnd
}
