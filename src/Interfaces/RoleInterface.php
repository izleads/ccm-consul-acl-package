<?php

namespace ConsulConfigManager\Consul\ACL\Interfaces;

use ArrayAccess;
use JsonSerializable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Contracts\Broadcasting\HasBroadcastChannel;

/**
 * Interface RoleInterface
 * @package ConsulConfigManager\Consul\ACL\Interfaces
 */
interface RoleInterface extends Arrayable, ArrayAccess, HasBroadcastChannel, Jsonable, JsonSerializable, QueueableEntity, UrlRoutable
{
    /**
     * Retrieve model by UUID
     * @param string $uuid
     * @param bool $withTrashed
     * @return RoleInterface|null
     */
    public static function uuid(string $uuid, bool $withTrashed = false): RoleInterface|null;

    /**
     * Get entity id
     * @return string
     */
    public function getID(): string;

    /**
     * Set entity id
     * @param string $id
     * @return $this
     */
    public function setID(string $id): self;

    /**
     * Get entity uuid
     * @return string
     */
    public function getUuid(): string;

    /**
     * Set entity uuid
     * @param string $uuid
     * @return $this
     */
    public function setUuid(string $uuid): self;

    /**
     * Get entity name
     * @return string
     */
    public function getName(): string;

    /**
     * Set entity name
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self;

    /**
     * Get entity description
     * @return string
     */
    public function getDescription(): string;

    /**
     * Set entity description
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self;

    /**
     * Get entity policies
     * @return array
     */
    public function getPolicies(): array;

    /**
     * Set entity policies
     * @param array $policies
     * @return $this
     */
    public function setPolicies(array $policies): self;
}
