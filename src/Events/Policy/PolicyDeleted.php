<?php

namespace ConsulConfigManager\Consul\ACL\Events\Policy;

use ConsulConfigManager\Consul\ACL\Events\AbstractEvent;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class PolicyDeleted
 * @package ConsulConfigManager\Consul\ACL\Events\Policy
 */
class PolicyDeleted extends AbstractEvent
{
    /**
     * PolicyDeleted constructor.
     * @param UserInterface|int|null $user
     * @return void
     */
    public function __construct(UserInterface|int|null $user = null)
    {
        $this->user = $user;
        parent::__construct();
    }
}
