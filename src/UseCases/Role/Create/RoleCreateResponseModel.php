<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Role\Create;

use ConsulConfigManager\Consul\ACL\Interfaces\RoleInterface;

/**
 * Class RoleCreateResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Role\Create
 */
class RoleCreateResponseModel
{
    /**
     * Entity instance
     * @var RoleInterface|null
     */
    private ?RoleInterface $entity;

    /**
     * RoleCreateResponseModel constructor.
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
