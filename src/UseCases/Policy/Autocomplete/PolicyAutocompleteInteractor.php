<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\ACL\Interfaces\PolicyRepositoryInterface;

/**
 * Class PolicyAutocompleteInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete
 */
class PolicyAutocompleteInteractor implements PolicyAutocompleteInputPort
{
    /**
     * Output port instance
     * @var PolicyAutocompleteOutputPort
     */
    private PolicyAutocompleteOutputPort $output;

    /**
     * Repository instance
     * @var PolicyRepositoryInterface
     */
    private PolicyRepositoryInterface $repository;

    /**
     * PolicyAutocompleteInteractor constructor.
     * @param PolicyAutocompleteOutputPort $output
     * @param PolicyRepositoryInterface $repository
     * @return void
     */
    public function __construct(PolicyAutocompleteOutputPort $output, PolicyRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function autocomplete(PolicyAutocompleteRequestModel $requestModel): ViewModel
    {
        try {
            $policies = $this->repository->all([
                'id', 'name', 'description',
            ])->toArray();
            return $this->output->autocomplete(new PolicyAutocompleteResponseModel($policies));
            // @codeCoverageIgnoreStart
        } catch (Throwable $exception) {
            return $this->output->internalServerError(new PolicyAutocompleteResponseModel(), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
