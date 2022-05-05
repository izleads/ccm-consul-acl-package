<?php

namespace ConsulConfigManager\Consul\ACL\Events\Role;

use ConsulConfigManager\Consul\ACL\Events\AbstractEvent;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class RoleDeleted
 * @package ConsulConfigManager\Consul\ACL\Events\Role
 */
class RoleDeleted extends AbstractEvent
{
    /**
     * RoleDeleted constructor.
     * @param UserInterface|int|null $user
     * @return void
     */
    public function __construct(UserInterface|int|null $user = null)
    {
        $this->user = $user;
        parent::__construct();
    }
}
