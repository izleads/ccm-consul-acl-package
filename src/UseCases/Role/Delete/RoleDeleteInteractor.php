<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleRepositoryInterface;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class RoleDeleteInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Delete
 */
class RoleDeleteInteractor implements RoleDeleteInputPort
{
    /**
     * Output port instance
     * @var RoleDeleteOutputPort
     */
    private RoleDeleteOutputPort $output;

    /**
     * Repository instance
     * @var RoleRepositoryInterface
     */
    private RoleRepositoryInterface $repository;

    /**
     * Service instance
     * @var AccessControlListServiceInterface
     */
    private AccessControlListServiceInterface $service;

    /**
     * RoleDeleteInteractor constructor.
     * @param RoleDeleteOutputPort $output
     * @param RoleRepositoryInterface $repository
     * @param AccessControlListServiceInterface $service
     */
    public function __construct(
        RoleDeleteOutputPort $output,
        RoleRepositoryInterface $repository,
        AccessControlListServiceInterface $service,
    ) {
        $this->output = $output;
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @inheritDoc
     */
    public function delete(RoleDeleteRequestModel $requestModel): ViewModel
    {
        $accessorID = $requestModel->getAccessorID();
        try {
            $model = $this->repository->findByManyOrFail(['id', 'uuid'], $accessorID);
            $this->repository->delete($model->getID());
            $this->service->deleteRole($accessorID);
            return $this->output->delete(new RoleDeleteResponseModel());
        } catch (Throwable $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->output->notFound(new RoleDeleteResponseModel());
            }
            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new RoleDeleteResponseModel(), $exception);
            // @codeCoverageIgnoreEnd
        }
    }
}
