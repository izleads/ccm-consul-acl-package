<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Update;

use Throwable;
use Illuminate\Support\Arr;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleRepositoryInterface;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class RoleUpdateInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Update
 */
class RoleUpdateInteractor implements RoleUpdateInputPort
{
    /**
     * Output port instance
     * @var RoleUpdateOutputPort
     */
    private RoleUpdateOutputPort $output;

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
     * RoleUpdateInteractor constructor.
     * @param RoleUpdateOutputPort $output
     * @param RoleRepositoryInterface $repository
     * @param AccessControlListServiceInterface $service
     */
    public function __construct(
        RoleUpdateOutputPort $output,
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
    public function update(RoleUpdateRequestModel $requestModel): ViewModel
    {
        $accessorID = $requestModel->getAccessorID();
        $request = $requestModel->getRequest();

        $policies = [];

        foreach ($request->get('policies') as $index => $data) {
            foreach ($data as $key => $value) {
                $key = strtolower($key);
                if ($key === 'id') {
                    $key = 'ID';
                } else {
                    $key = ucfirst($key);
                }
                $policies[$index][$key] = $value;
            }
        }

        try {
            if ($this->repository->find($accessorID) === null) {
                $remoteRole = $this->service->readRole($accessorID);
                $this->repository->create(
                    Arr::get($remoteRole, 'id'),
                    Arr::get($remoteRole, 'name'),
                    Arr::get($remoteRole, 'description'),
                    Arr::get($remoteRole, 'policies'),
                );
            }
            $updateQuery = [
                'Name'          =>  $request->get('name'),
                'Description'   =>  $request->get('description'),
            ];
            if (count($policies) > 0) {
                $updateQuery['Policies'] = $policies;
            }

            $remotelyUpdatedRole = $this->service->updateRole($accessorID, $updateQuery);
            $locallyUpdatedRole = $this->repository->update(
                Arr::get($remotelyUpdatedRole, 'id'),
                Arr::get($remotelyUpdatedRole, 'name'),
                Arr::get($remotelyUpdatedRole, 'description'),
                Arr::get($remotelyUpdatedRole, 'policies'),
            );
            return $this->output->update(new RoleUpdateResponseModel($locallyUpdatedRole));
            // @codeCoverageIgnoreStart
        } catch (Throwable $exception) {
            if ($exception instanceof RequestException) {
                if (str_contains(strtolower($exception->getMessage()), 'not found')) {
                    return $this->output->notFound(new RoleUpdateResponseModel());
                }
            }
            return $this->output->internalServerError(new RoleUpdateResponseModel(), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
