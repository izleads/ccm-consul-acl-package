<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleRepositoryInterface;

/**
 * Class RoleGetInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Get
 */
class RoleGetInteractor implements RoleGetInputPort
{
    /**
     * Output port instance
     * @var RoleGetOutputPort
     */
    private RoleGetOutputPort $output;

    /**
     * Repository instance
     * @var RoleRepositoryInterface
     */
    private RoleRepositoryInterface $repository;

    /**
     * RoleGetInteractor constructor.
     * @param RoleGetOutputPort $output
     * @param RoleRepositoryInterface $repository
     * @return void
     */
    public function __construct(RoleGetOutputPort $output, RoleRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function get(RoleGetRequestModel $requestModel): ViewModel
    {
        $roleID = $requestModel->getRoleID();
        try {
            $model = $this->repository->findByManyOrFail(['id', 'uuid'], $roleID);
            return $this->output->get(new RoleGetResponseModel($model));
        } catch (Throwable $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->output->notFound(new RoleGetResponseModel());
            }
            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new RoleGetResponseModel(), $exception);
            // @codeCoverageIgnoreEnd
        }
    }
}
