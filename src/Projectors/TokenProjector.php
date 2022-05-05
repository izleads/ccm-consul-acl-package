<?php

namespace ConsulConfigManager\Consul\ACL\Projectors;

use ConsulConfigManager\Consul\ACL\Events;
use ConsulConfigManager\Consul\ACL\Models\Token;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

/**
 * Class TokenProjector
 * @package ConsulConfigManager\Consul\ACL\Projectors
 */
class TokenProjector extends Projector
{
    /**
     * Handle `created` event
     * @param Events\Token\TokenCreated $event
     * @return void
     */
    public function onCreated(Events\Token\TokenCreated $event): void
    {
        Token::create([
            'id'            =>  $event->getId(),
            'uuid'          =>  $event->aggregateRootUuid(),
            'secret'        =>  $event->getSecret(),
            'description'   =>  $event->getDescription(),
            'roles'         =>  $event->getRoles(),
            'policies'      =>  $event->getPolicies(),
            'local'         =>  $event->isLocal(),
        ]);
    }

    /**
     * Handle `updated` event
     * @param Events\Token\TokenUpdated $event
     * @return void
     */
    public function onUpdated(Events\Token\TokenUpdated $event): void
    {
        $uuid = $event->aggregateRootUuid();
        $model = Token::uuid($uuid);
        $model->setSecret($event->getSecret());
        $model->setDescription($event->getDescription());
        $model->setRoles($event->getRoles());
        $model->setPolicies($event->getPolicies());
        $model->setLocal($event->isLocal());
        $model->save();
    }

    /**
     * Handle `deleted` event
     * @param Events\Token\TokenDeleted $event
     * @return void
     */
    public function onDeleted(Events\Token\TokenDeleted $event): void
    {
        Token::uuid($event->aggregateRootUuid())->delete();
    }
}
