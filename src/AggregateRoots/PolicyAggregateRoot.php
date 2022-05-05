<?php

namespace ConsulConfigManager\Consul\ACL\AggregateRoots;

use ConsulConfigManager\Consul\ACL\Events;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class PolicyAggregateRoot
 * @package ConsulConfigManager\Consul\ACL\AggregateRoots
 */
class PolicyAggregateRoot extends AggregateRoot
{
    /**
     * Handle `create` event
     * @param string $id
     * @param string $name
     * @param string $description
     * @param string $rules
     * @param UserInterface|int|null $user
     * @return $this
     */
    public function createEntity(string $id, string $name, string $description, string $rules, UserInterface|int|null $user = null): PolicyAggregateRoot
    {
        $this->recordThat(new Events\Policy\PolicyCreated(
            $id,
            $name,
            $description,
            $rules,
            $user
        ));
        return $this;
    }

    /**
     * Handle `update` event
     * @param string $name
     * @param string $description
     * @param string $rules
     * @param UserInterface|int|null $user
     * @return $this
     */
    public function updateEntity(string $name, string $description, string $rules, UserInterface|int|null $user = null): PolicyAggregateRoot
    {
        $this->recordThat(new Events\Policy\PolicyUpdated(
            $name,
            $description,
            $rules,
            $user
        ));
        return $this;
    }

    /**
     * Handle `delete` event
     * @param UserInterface|int|null $user
     * @return $this
     */
    public function deleteEntity(UserInterface|int|null $user = null): PolicyAggregateRoot
    {
        $this->recordThat(new Events\Policy\PolicyDeleted($user));
        return $this;
    }
}
