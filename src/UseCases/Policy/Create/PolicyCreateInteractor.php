<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Create;

use Throwable;
use Illuminate\Support\Arr;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\ACL\Interfaces\PolicyRepositoryInterface;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class PolicyCreateInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Create
 */
class PolicyCreateInteractor implements PolicyCreateInputPort
{
    /**
     * Output port instance
     * @var PolicyCreateOutputPort
     */
    private PolicyCreateOutputPort $output;

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
     * PolicyCreateInteractor constructor.
     * @param PolicyCreateOutputPort $output
     * @param PolicyRepositoryInterface $repository
     * @param AccessControlListServiceInterface $service
     */
    public function __construct(
        PolicyCreateOutputPort $output,
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
    public function create(PolicyCreateRequestModel $requestModel): ViewModel
    {
        $request = $requestModel->getRequest();

        try {
            if ($this->repository->findBy('name', $request->get('name')) === null) {
                $remotelyCreatedPolicy = $this->service->createPolicy([
                    'Name'          =>  $request->get('name'),
                    'Description'   =>  $request->get('description'),
                    'Rules'         =>  $request->get('rules'),
                ]);
                $locallyCreatedPolicy = $this->repository->create(
                    Arr::get($remotelyCreatedPolicy, 'id'),
                    Arr::get($remotelyCreatedPolicy, 'name'),
                    Arr::get($remotelyCreatedPolicy, 'description'),
                    Arr::get($remotelyCreatedPolicy, 'rules'),
                );
                return $this->output->create(new PolicyCreateResponseModel($locallyCreatedPolicy));
            }
            return $this->output->alreadyExists(new PolicyCreateResponseModel());
            // @codeCoverageIgnoreStart
        } catch (Throwable $exception) {
            if ($exception instanceof RequestException) {
                if (str_contains($exception->getMessage(), 'already exists')) {
                    return $this->output->alreadyExists(new PolicyCreateResponseModel());
                }
            }
            return $this->output->internalServerError(new PolicyCreateResponseModel(), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
