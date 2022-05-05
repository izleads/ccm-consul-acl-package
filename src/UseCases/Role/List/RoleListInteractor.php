<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleRepositoryInterface;

/**
 * Class RoleListInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\List
 */
class RoleListInteractor implements RoleListInputPort
{
    /**
     * Output port instance
     * @var RoleListOutputPort
     */
    private RoleListOutputPort $output;

    /**
     * Repository instance
     * @var RoleRepositoryInterface
     */
    private RoleRepositoryInterface $repository;

    /**
     * RoleListInteractor constructor.
     * @param RoleListOutputPort $output
     * @param RoleRepositoryInterface $repository
     * @return void
     */
    public function __construct(RoleListOutputPort $output, RoleRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function list(RoleListRequestModel $requestModel): ViewModel
    {
        try {
            $roles = $this->repository->all([
                'id', 'uuid',
                'name', 'description',
                'created_at', 'updated_at',
            ])->toArray();
            return $this->output->list(new RoleListResponseModel($roles));
            // @codeCoverageIgnoreStart
        } catch (Throwable $exception) {
            return $this->output->internalServerError(new RoleListResponseModel(), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
