<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\ACL\Interfaces\PolicyRepositoryInterface;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class PolicyDeleteInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete
 */
class PolicyDeleteInteractor implements PolicyDeleteInputPort
{
    /**
     * Output port instance
     * @var PolicyDeleteOutputPort
     */
    private PolicyDeleteOutputPort $output;

    /**
     * Repository instance
     * @var PolicyRepositoryInterface
     */
    private PolicyRepositoryInterface $repository;

    /**
     * Service instance
     * @var AccessControlListServiceInterface
     */
    private AccessControlListServiceInterface $service;

    /**
     * PolicyDeleteInteractor constructor.
     * @param PolicyDeleteOutputPort $output
     * @param PolicyRepositoryInterface $repository
     * @param AccessControlListServiceInterface $service
     */
    public function __construct(
        PolicyDeleteOutputPort $output,
        PolicyRepositoryInterface $repository,
        AccessControlListServiceInterface $service,
    ) {
        $this->output = $output;
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @inheritDoc
     */
    public function delete(PolicyDeleteRequestModel $requestModel): ViewModel
    {
        $accessorID = $requestModel->getAccessorID();
        try {
            $model = $this->repository->findByManyOrFail(['id', 'uuid'], $accessorID);
            $this->repository->delete($model->getID());
            $this->service->deletePolicy($accessorID);
            return $this->output->delete(new PolicyDeleteResponseModel());
        } catch (Throwable $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->output->notFound(new PolicyDeleteResponseModel());
            }
            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new PolicyDeleteResponseModel(), $exception);
            // @codeCoverageIgnoreEnd
        }
    }
}
