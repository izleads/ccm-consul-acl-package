<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete;

/**
 * Class PolicyAutocompleteResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete
 */
class PolicyAutocompleteResponseModel
{
    /**
     * Autocomplete of policies
     * @var array
     */
    private array $policies;

    /**
     * PolicyAutocompleteResponseModel constructor.
     * @param array $policies
     * @return void
     */
    public function __construct(array $policies = [])
    {
        $this->policies = $policies;
    }

    /**
     * Get autocomplete of policies
     * @return array
     */
    public function getPolicies(): array
    {
        return $this->policies;
    }
}
