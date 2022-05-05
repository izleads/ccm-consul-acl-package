<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Update;

use Throwable;
use Illuminate\Support\Arr;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\ACL\Interfaces\TokenRepositoryInterface;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class TokenUpdateInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Update
 */
class TokenUpdateInteractor implements TokenUpdateInputPort
{
    /**
     * Output port instance
     * @var TokenUpdateOutputPort
     */
    private TokenUpdateOutputPort $output;

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
     * TokenUpdateInteractor constructor.
     * @param TokenUpdateOutputPort $output
     * @param TokenRepositoryInterface $repository
     * @param AccessControlListServiceInterface $service
     */
    public function __construct(
        TokenUpdateOutputPort $output,
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
    public function update(TokenUpdateRequestModel $requestModel): ViewModel
    {
        $accessorID = $requestModel->getAccessorID();
        $request = $requestModel->getRequest();

        try {
            if ($this->repository->find($accessorID) === null) {
                $remoteToken = $this->service->readToken($accessorID);
                $this->repository->create(
                    Arr::get($remoteToken, 'accessor_id'),
                    Arr::get($remoteToken, 'secret_id'),
                    Arr::get($remoteToken, 'description'),
                    Arr::get($remoteToken, 'roles', []),
                    Arr::get($remoteToken, 'policies', []),
                    Arr::get($remoteToken, 'local'),
                );
            }
            $remotelyUpdatedToken = $this->service->updateToken($accessorID, [
                'Description'   =>  $request->get('description'),
                'Roles'         =>  $request->get('roles', []),
                'Policies'      =>  $request->get('policies', []),
            ]);
            $locallyUpdatedToken = $this->repository->update(
                Arr::get($remotelyUpdatedToken, 'accessor_id'),
                Arr::get($remotelyUpdatedToken, 'secret_id'),
                Arr::get($remotelyUpdatedToken, 'description'),
                Arr::get($remotelyUpdatedToken, 'roles', []),
                Arr::get($remotelyUpdatedToken, 'policies', []),
                Arr::get($remotelyUpdatedToken, 'local'),
            );
            return $this->output->update(new TokenUpdateResponseModel($locallyUpdatedToken));
            // @codeCoverageIgnoreStart
        } catch (Throwable $exception) {
            if ($exception instanceof RequestException) {
                if (str_contains(strtolower($exception->getMessage()), 'not found')) {
                    return $this->output->notFound(new TokenUpdateResponseModel());
                }
            }
            return $this->output->internalServerError(new TokenUpdateResponseModel(), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
