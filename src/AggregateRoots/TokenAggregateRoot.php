<?php

namespace ConsulConfigManager\Consul\ACL\AggregateRoots;

use ConsulConfigManager\Consul\ACL\Events;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class TokenAggregateRoot
 * @package ConsulConfigManager\Consul\ACL\AggregateRoots
 */
class TokenAggregateRoot extends AggregateRoot
{
    /**
     * Handle `create` event
     * @param string $id
     * @param string $secret
     * @param string $description
     * @param array $roles
     * @param array $policies
     * @param bool $local
     * @param UserInterface|int|null $user
     * @return $this
     */
    public function createEntity(string $id, string $secret, string $description, array $roles, array $policies, bool $local, UserInterface|int|null $user = null): TokenAggregateRoot
    {
        $this->recordThat(new Events\Token\TokenCreated(
            $id,
            $secret,
            $description,
            $roles,
            $policies,
            $local,
            $user,
        ));
        return $this;
    }

    /**
     * Handle `update` event
     * @param string $secret
     * @param string $description
     * @param array $roles
     * @param array $policies
     * @param bool $local
     * @param UserInterface|int|null $user
     * @return $this
     */
    public function updateEntity(string $secret, string $description, array $roles, array $policies, bool $local, UserInterface|int|null $user = null): TokenAggregateRoot
    {
        $this->recordThat(new Events\Token\TokenUpdated(
            $secret,
            $description,
            $roles,
            $policies,
            $local,
            $user,
        ));
        return $this;
    }

    /**
     * Handle `delete` event
     * @param UserInterface|int|null $user
     * @return $this
     */
    public function deleteEntity(UserInterface|int|null $user = null): TokenAggregateRoot
    {
        $this->recordThat(new Events\Token\TokenDeleted(
            $user,
        ));
        return $this;
    }
}
