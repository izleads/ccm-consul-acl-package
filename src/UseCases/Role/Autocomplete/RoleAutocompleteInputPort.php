<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface RoleAutocompleteInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete
 */
interface RoleAutocompleteInputPort
{
    /**
     * Get autocomplete of all ACL roles
     * @param RoleAutocompleteRequestModel $requestModel
     * @return ViewModel
     */
    public function autocomplete(RoleAutocompleteRequestModel $requestModel): ViewModel;
}
