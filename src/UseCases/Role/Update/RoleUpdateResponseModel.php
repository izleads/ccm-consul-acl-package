<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Update;

use ConsulConfigManager\Consul\ACL\Interfaces\RoleInterface;

/**
 * Class RoleUpdateResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Update
 */
class RoleUpdateResponseModel
{
    /**
     * Entity instance
     * @var RoleInterface|null
     */
    private ?RoleInterface $entity;

    /**
     * RoleUpdateResponseModel constructor.
     * @param RoleInterface|null $entity
     * @return void
     */
    public function __construct(RoleInterface $entity = null)
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
