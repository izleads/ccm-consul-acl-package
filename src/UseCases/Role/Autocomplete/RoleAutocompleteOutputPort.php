<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleAutocompleteOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete
 */
interface RoleAutocompleteOutputPort
{
    /**
     * Output port for "autocomplete"
     * @param RoleAutocompleteResponseModel $responseModel
     * @return ViewModel
     */
    public function autocomplete(RoleAutocompleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param RoleAutocompleteResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(RoleAutocompleteResponseModel $responseModel, Throwable $exception): ViewModel;
}
