<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PolicyAutocompleteInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete
 */
interface PolicyAutocompleteInputPort
{
    /**
     * Get autocomplete of all ACL policies
     * @param PolicyAutocompleteRequestModel $requestModel
     * @return ViewModel
     */
    public function autocomplete(PolicyAutocompleteRequestModel $requestModel): ViewModel;
}
