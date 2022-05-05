<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete;

/**
 * Class RoleAutocompleteResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Autocomplete
 */
class RoleAutocompleteResponseModel
{
    /**
     * Autocomplete of roles
     * @var array
     */
    private array $roles;

    /**
     * RoleAutocompleteResponseModel constructor.
     * @param array $roles
     * @return void
     */
    public function __construct(array $roles = [])
    {
        $this->roles = $roles;
    }

    /**
     * Get autocomplete of roles
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }
}
