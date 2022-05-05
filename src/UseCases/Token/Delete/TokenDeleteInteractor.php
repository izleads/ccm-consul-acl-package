<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\ACL\Interfaces\TokenRepositoryInterface;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class TokenDeleteInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Delete
 */
class TokenDeleteInteractor implements TokenDeleteInputPort
{
    /**
     * Output port instance
     * @var TokenDeleteOutputPort
     */
    private TokenDeleteOutputPort $output;

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
     * TokenDeleteInteractor constructor.
     * @param TokenDeleteOutputPort $output
     * @param TokenRepositoryInterface $repository
     * @param AccessControlListServiceInterface $service
     */
    public function __construct(
        TokenDeleteOutputPort $output,
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
    public function delete(TokenDeleteRequestModel $requestModel): ViewModel
    {
        $accessorID = $requestModel->getAccessorID();
        try {
            $model = $this->repository->findByManyOrFail(['id', 'uuid'], $accessorID);
            $this->repository->delete($model->getID());
            $this->service->deleteToken($accessorID);
            return $this->output->delete(new TokenDeleteResponseModel());
        } catch (Throwable $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->output->notFound(new TokenDeleteResponseModel());
            }
            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new TokenDeleteResponseModel(), $exception);
            // @codeCoverageIgnoreEnd
        }
    }
}
