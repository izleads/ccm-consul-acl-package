<?php

namespace ConsulConfigManager\Consul\ACL\AggregateRoots;

use ConsulConfigManager\Consul\ACL\Events;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class RoleAggregateRoot
 * @package ConsulConfigManager\Consul\ACL\AggregateRoots
 */
class RoleAggregateRoot extends AggregateRoot
{
    /**
     * Handle `create` event
     * @param string $id
     * @param string $name
     * @param string $description
     * @param array $policies
     * @param UserInterface|int|null $user
     * @return $this
     */
    public function createEntity(string $id, string $name, string $description, array $policies, UserInterface|int|null $user = null): RoleAggregateRoot
    {
        $this->recordThat(new Events\Role\RoleCreated(
            $id,
            $name,
            $description,
            $policies,
            $user,
        ));
        return $this;
    }

    /**
     * Handle `update` event
     * @param string $name
     * @param string $description
     * @param array $policies
     * @param UserInterface|int|null $user
     * @return $this
     */
    public function updateEntity(string $name, string $description, array $policies, UserInterface|int|null $user = null): RoleAggregateRoot
    {
        $this->recordThat(new Events\Role\RoleUpdated(
            $name,
            $description,
            $policies,
            $user,
        ));
        return $this;
    }

    /**
     * Handle `delete` event
     * @param UserInterface|int|null $user
     * @return $this
     */
    public function deleteEntity(UserInterface|int|null $user = null): RoleAggregateRoot
    {
        $this->recordThat(new Events\Role\RoleDeleted(
            $user,
        ));
        return $this;
    }
}
