<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Get;

use ConsulConfigManager\Consul\ACL\Interfaces\RoleInterface;

/**
 * Class RoleGetResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Get
 */
class RoleGetResponseModel
{
    /**
     * Entity instance
     * @var RoleInterface|null
     */
    private ?RoleInterface $entity;

    /**
     * RoleGetResponseModel constructor.
     * @param RoleInterface|null $entity
     * @return void
     */
    public function __construct(?RoleInterface $entity = null)
    {
        $this->entity = $entity;
    }

    /**
     * Get entity
     * @return RoleInterface|null
     */
    public function getEntity(): ?RoleInterface
    {
        return $this->entity;
    }
}
