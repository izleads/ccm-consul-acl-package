<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\List;

/**
 * Class RoleListResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\List
 */
class RoleListResponseModel
{
    /**
     * List of roles
     * @var array
     */
    private array $roles;

    /**
     * RoleListResponseModel constructor.
     * @param array $roles
     * @return void
     */
    public function __construct(array $roles = [])
    {
        $this->roles = $roles;
    }

    /**
     * Get list of roles
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }
}
