<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\ACL\Interfaces\PolicyRepositoryInterface;

/**
 * Class PolicyGetInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Get
 */
class PolicyGetInteractor implements PolicyGetInputPort
{
    /**
     * Output port instance
     * @var PolicyGetOutputPort
     */
    private PolicyGetOutputPort $output;

    /**
     * Repository instance
     * @var PolicyRepositoryInterface
     */
    private PolicyRepositoryInterface $repository;

    /**
     * PolicyGetInteractor constructor.
     * @param PolicyGetOutputPort $output
     * @param PolicyRepositoryInterface $repository
     * @return void
     */
    public function __construct(PolicyGetOutputPort $output, PolicyRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function get(PolicyGetRequestModel $requestModel): ViewModel
    {
        $policyID = $requestModel->getPolicyID();
        try {
            $model = $this->repository->findByManyOrFail(['id', 'uuid'], $policyID);
            return $this->output->get(new PolicyGetResponseModel($model));
        } catch (Throwable $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->output->notFound(new PolicyGetResponseModel());
            }
            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new PolicyGetResponseModel(), $exception);
            // @codeCoverageIgnoreEnd
        }
    }
}
