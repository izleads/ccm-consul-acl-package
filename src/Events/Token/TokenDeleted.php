<?php

namespace ConsulConfigManager\Consul\ACL\Events\Token;

use ConsulConfigManager\Consul\ACL\Events\AbstractEvent;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class TokenDeleted
 * @package ConsulConfigManager\Consul\ACL\Events\Token
 */
class TokenDeleted extends AbstractEvent
{
    /**
     * TokenDeleted constructor.
     * @param UserInterface|int|null $user
     * @return void
     */
    public function __construct(UserInterface|int|null $user = null)
    {
        $this->user = $user;
        parent::__construct();
    }
}
