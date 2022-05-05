<?php

namespace ConsulConfigManager\Consul\ACL\Projectors;

use ConsulConfigManager\Consul\ACL\Events;
use ConsulConfigManager\Consul\ACL\Models\Role;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

/**
 * Class RoleProjector
 * @package ConsulConfigManager\Consul\ACL\Projectors
 */
class RoleProjector extends Projector
{
    /**
     * Handle `created` event
     * @param Events\Role\RoleCreated $event
     * @return void
     */
    public function onCreated(Events\Role\RoleCreated $event): void
    {
        Role::create([
            'id'            =>  $event->getId(),
            'uuid'          =>  $event->aggregateRootUuid(),
            'name'          =>  $event->getName(),
            'description'   =>  $event->getDescription(),
            'policies'      =>  $event->getPolicies(),
        ]);
    }

    /**
     * Handle `updated` event
     * @param Events\Role\RoleUpdated $event
     * @return void
     */
    public function onUpdated(Events\Role\RoleUpdated $event): void
    {
        $uuid = $event->aggregateRootUuid();
        $model = Role::uuid($uuid);
        $model->setName($event->getName());
        $model->setDescription($event->getDescription());
        $model->setPolicies($event->getPolicies());
        $model->save();
    }

    /**
     * Handle `deleted` event
     * @param Events\Role\RoleDeleted $event
     * @return void
     */
    public function onDeleted(Events\Role\RoleDeleted $event): void
    {
        Role::uuid($event->aggregateRootUuid())->delete();
    }
}
