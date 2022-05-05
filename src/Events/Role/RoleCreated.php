<?php

namespace ConsulConfigManager\Consul\ACL\Events\Role;

use ConsulConfigManager\Consul\ACL\Events\AbstractEvent;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class RoleCreated
 * @package ConsulConfigManager\Consul\ACL\Events\Role
 */
class RoleCreated extends AbstractEvent
{
    /**
     * Role id
     * @var string
     */
    private string $id;

    /**
     * Role name
     * @var string
     */
    private string $name;

    /**
     * Role description
     * @var string
     */
    private string $description;

    /**
     * Role policies
     * @var array
     */
    private array $policies;

    /**
     * RoleCreated constructor.
     * @param string $id
     * @param string $name
     * @param string $description
     * @param array $policies
     * @param UserInterface|int|null $user
     * @return void
     */
    public function __construct(string $id, string $name, string $description, array $policies, UserInterface|int|null $user = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->policies = $policies;
        $this->user = $user;
        parent::__construct();
    }

    /**
     * Get role id
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get role name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get role description
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get role policies
     * @return array
     */
    public function getPolicies(): array
    {
        return $this->policies;
    }
}
