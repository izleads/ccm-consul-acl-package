<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleRepositoryInterface;

/**
 * Class RoleAutocompleteInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete
 */
class RoleAutocompleteInteractor implements RoleAutocompleteInputPort
{
    /**
     * Output port instance
     * @var RoleAutocompleteOutputPort
     */
    private RoleAutocompleteOutputPort $output;

    /**
     * Repository instance
     * @var RoleRepositoryInterface
     */
    private RoleRepositoryInterface $repository;

    /**
     * RoleAutocompleteInteractor constructor.
     * @param RoleAutocompleteOutputPort $output
     * @param RoleRepositoryInterface $repository
     * @return void
     */
    public function __construct(RoleAutocompleteOutputPort $output, RoleRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function autocomplete(RoleAutocompleteRequestModel $requestModel): ViewModel
    {
        try {
            $roles = $this->repository->all([
                'id', 'name', 'description',
            ])->toArray();
            return $this->output->autocomplete(new RoleAutocompleteResponseModel($roles));
            // @codeCoverageIgnoreStart
        } catch (Throwable $exception) {
            return $this->output->internalServerError(new RoleAutocompleteResponseModel(), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
