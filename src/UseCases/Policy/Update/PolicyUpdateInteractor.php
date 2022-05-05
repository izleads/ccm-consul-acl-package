<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Update;

use Throwable;
use Illuminate\Support\Arr;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\ACL\Interfaces\PolicyRepositoryInterface;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class PolicyUpdateInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Update
 */
class PolicyUpdateInteractor implements PolicyUpdateInputPort
{
    /**
     * Output port instance
     * @var PolicyUpdateOutputPort
     */
    private PolicyUpdateOutputPort $output;

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
     * PolicyUpdateInteractor constructor.
     * @param PolicyUpdateOutputPort $output
     * @param PolicyRepositoryInterface $repository
     * @param AccessControlListServiceInterface $service
     */
    public function __construct(
        PolicyUpdateOutputPort $output,
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
    public function update(PolicyUpdateRequestModel $requestModel): ViewModel
    {
        $accessorID = $requestModel->getAccessorID();
        $request = $requestModel->getRequest();

        try {
            if ($this->repository->find($accessorID) === null) {
                $remotePolicy = $this->service->readPolicy($accessorID);
                $this->repository->create(
                    Arr::get($remotePolicy, 'id'),
                    Arr::get($remotePolicy, 'name'),
                    Arr::get($remotePolicy, 'description'),
                    Arr::get($remotePolicy, 'rules'),
                );
            }
            $remotelyUpdatedPolicy = $this->service->updatePolicy($accessorID, [
                'Name'          =>  $request->get('name'),
                'Description'   =>  $request->get('description'),
                'Rules'         =>  $request->get('rules'),
            ]);
            $locallyUpdatedPolicy = $this->repository->update(
                Arr::get($remotelyUpdatedPolicy, 'id'),
                Arr::get($remotelyUpdatedPolicy, 'name'),
                Arr::get($remotelyUpdatedPolicy, 'description'),
                Arr::get($remotelyUpdatedPolicy, 'rules'),
            );
            return $this->output->update(new PolicyUpdateResponseModel($locallyUpdatedPolicy));
            // @codeCoverageIgnoreStart
        } catch (Throwable $exception) {
            if ($exception instanceof RequestException) {
                if (str_contains($exception->getMessage(), 'not found')) {
                    return $this->output->notFound(new PolicyUpdateResponseModel());
                }
            }
            return $this->output->internalServerError(new PolicyUpdateResponseModel(), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
