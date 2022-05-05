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
 * Interface PolicyInterface
 * @package ConsulConfigManager\Consul\ACL\Interfaces
 */
interface PolicyInterface extends Arrayable, ArrayAccess, HasBroadcastChannel, Jsonable, JsonSerializable, QueueableEntity, UrlRoutable
{
    /**
     * Retrieve model by UUID
     * @param string $uuid
     * @param bool $withTrashed
     * @return PolicyInterface|null
     */
    public static function uuid(string $uuid, bool $withTrashed = false): PolicyInterface|null;

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
     * Get entity rules
     * @return string
     */
    public function getRules(): string;

    /**
     * Set entity rules
     * @param string $rules
     * @return $this
     */
    public function setRules(string $rules): self;
}
