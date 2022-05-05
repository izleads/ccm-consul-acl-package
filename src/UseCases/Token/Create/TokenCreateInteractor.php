<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Create;

use Throwable;
use Illuminate\Support\Arr;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\ACL\Interfaces\TokenRepositoryInterface;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class TokenCreateInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Create
 */
class TokenCreateInteractor implements TokenCreateInputPort
{
    /**
     * Output port instance
     * @var TokenCreateOutputPort
     */
    private TokenCreateOutputPort $output;

    /**
     * Repository instance
     * @var TokenRepositoryInterface
     */
    private TokenRepositoryInterface $repository;

    /**
     * Service instance
     * @var AccessControlListServiceInterface
     */
    private AccessControlListServiceInterface $service;

    /**
     * TokenCreateInteractor constructor.
     * @param TokenCreateOutputPort $output
     * @param TokenRepositoryInterface $repository
     * @param AccessControlListServiceInterface $service
     */
    public function __construct(
        TokenCreateOutputPort $output,
        TokenRepositoryInterface $repository,
        AccessControlListServiceInterface $service,
    ) {
        $this->output = $output;
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @inheritDoc
     */
    public function create(TokenCreateRequestModel $requestModel): ViewModel
    {
        $request = $requestModel->getRequest();
        try {
            $remotelyCreatedToken = $this->service->createToken([
                'Description'   =>  $request->get('description'),
                'Roles'         =>  $request->get('roles', []),
                'Policies'      =>  $request->get('policies', []),
            ]);
            $locallyCreatedToken = $this->repository->create(
                Arr::get($remotelyCreatedToken, 'accessor_id'),
                Arr::get($remotelyCreatedToken, 'secret_id'),
                Arr::get($remotelyCreatedToken, 'description'),
                Arr::get($remotelyCreatedToken, 'roles', []),
                Arr::get($remotelyCreatedToken, 'policies', []),
                Arr::get($remotelyCreatedToken, 'local'),
            );
            return $this->output->create(new TokenCreateResponseModel($locallyCreatedToken));
            // @codeCoverageIgnoreStart
        } catch (Throwable $exception) {
            return $this->output->internalServerError(new TokenCreateResponseModel(), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
