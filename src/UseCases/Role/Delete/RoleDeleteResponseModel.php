<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Delete;

use ConsulConfigManager\Consul\ACL\Interfaces\RoleInterface;

/**
 * Class RoleDeleteResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Delete
 */
class RoleDeleteResponseModel
{
    /**
     * Entity instance
     * @var RoleInterface|null
     */
    private ?RoleInterface $entity;

    /**
     * RoleDeleteResponseModel constructor.
     * @param RoleInterface|null $entity
     * @return void
     */
    public function __construct(?RoleInterface $entity = null)
    {
        $this->entity = $entity;
    }

    /**
     * Delete entity
     * @return RoleInterface|null
     */
    public function getEntity(): ?RoleInterface
    {
        return $this->entity;
    }
}
