<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Create;

use Throwable;
use Illuminate\Support\Arr;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleRepositoryInterface;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class RoleCreateInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Create
 */
class RoleCreateInteractor implements RoleCreateInputPort
{
    /**
     * Output port instance
     * @var RoleCreateOutputPort
     */
    private RoleCreateOutputPort $output;

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
     * RoleCreateInteractor constructor.
     * @param RoleCreateOutputPort $output
     * @param RoleRepositoryInterface $repository
     * @param AccessControlListServiceInterface $service
     */
    public function __construct(
        RoleCreateOutputPort $output,
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
    public function create(RoleCreateRequestModel $requestModel): ViewModel
    {
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
            if ($this->repository->findBy('name', $request->get('name')) === null) {
                $remotelyCreatedRole = $this->service->createRole([
                    'Name'          =>  $request->get('name'),
                    'Description'   =>  $request->get('description'),
                    'Policies'      =>  $policies,
                ]);
                $locallyCreatedRole = $this->repository->create(
                    Arr::get($remotelyCreatedRole, 'id'),
                    Arr::get($remotelyCreatedRole, 'name'),
                    Arr::get($remotelyCreatedRole, 'description'),
                    Arr::get($remotelyCreatedRole, 'policies'),
                );
                return $this->output->create(new RoleCreateResponseModel($locallyCreatedRole));
            }
            return $this->output->alreadyExists(new RoleCreateResponseModel());
            // @codeCoverageIgnoreStart
        } catch (Throwable $exception) {
            if ($exception instanceof RequestException) {
                if (str_contains($exception->getMessage(), 'already exists')) {
                    return $this->output->alreadyExists(new RoleCreateResponseModel());
                }
            }
            return $this->output->internalServerError(new RoleCreateResponseModel(), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
