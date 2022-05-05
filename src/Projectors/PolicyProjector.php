<?php

namespace ConsulConfigManager\Consul\ACL\Projectors;

use ConsulConfigManager\Consul\ACL\Events;
use ConsulConfigManager\Consul\ACL\Models\Policy;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

/**
 * Class PolicyProjector
 * @package ConsulConfigManager\Consul\ACL\Projectors
 */
class PolicyProjector extends Projector
{
    /**
     * Handle `created` event
     * @param Events\Policy\PolicyCreated $event
     * @return void
     */
    public function onCreated(Events\Policy\PolicyCreated $event): void
    {
        Policy::create([
            'id'            =>  $event->getId(),
            'uuid'          =>  $event->aggregateRootUuid(),
            'name'          =>  $event->getName(),
            'description'   =>  $event->getDescription(),
            'rules'         =>  $event->getRules(),
        ]);
    }

    /**
     * Handle `updated` event
     * @param Events\Policy\PolicyUpdated $event
     * @return void
     */
    public function onUpdated(Events\Policy\PolicyUpdated $event): void
    {
        $uuid = $event->aggregateRootUuid();
        $model = Policy::uuid($uuid);
        $model->setName($event->getName());
        $model->setDescription($event->getDescription());
        $model->setRules($event->getRules());
        $model->save();
    }

    /**
     * Handle `deleted` event
     * @param Events\Policy\PolicyDeleted $event
     * @return void
     */
    public function onDeleted(Events\Policy\PolicyDeleted $event): void
    {
        Policy::uuid($event->aggregateRootUuid())->delete();
    }
}
