<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\ACL\Interfaces\PolicyRepositoryInterface;

/**
 * Class PolicyListInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\List
 */
class PolicyListInteractor implements PolicyListInputPort
{
    /**
     * Output port instance
     * @var PolicyListOutputPort
     */
    private PolicyListOutputPort $output;

    /**
     * Repository instance
     * @var PolicyRepositoryInterface
     */
    private PolicyRepositoryInterface $repository;

    /**
     * PolicyListInteractor constructor.
     * @param PolicyListOutputPort $output
     * @param PolicyRepositoryInterface $repository
     * @return void
     */
    public function __construct(PolicyListOutputPort $output, PolicyRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function list(PolicyListRequestModel $requestModel): ViewModel
    {
        try {
            $policies = $this->repository->all([
                'id', 'uuid',
                'name', 'description',
                'created_at', 'updated_at',
            ])->toArray();
            return $this->output->list(new PolicyListResponseModel($policies));
            // @codeCoverageIgnoreStart
        } catch (Throwable $exception) {
            return $this->output->internalServerError(new PolicyListResponseModel(), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
