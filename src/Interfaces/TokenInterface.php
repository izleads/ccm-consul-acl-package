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
 * Interface TokenInterface
 * @package ConsulConfigManager\Consul\ACL\Interfaces
 */
interface TokenInterface extends Arrayable, ArrayAccess, HasBroadcastChannel, Jsonable, JsonSerializable, QueueableEntity, UrlRoutable
{
    /**
     * Retrieve model by UUID
     * @param string $uuid
     * @param bool $withTrashed
     * @return TokenInterface|null
     */
    public static function uuid(string $uuid, bool $withTrashed = false): TokenInterface|null;

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
     * Get entity secret
     * @return string
     */
    public function getSecret(): string;

    /**
     * Set entity secret
     * @param string $secret
     * @return $this
     */
    public function setSecret(string $secret): self;

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
     * Get entity roles
     * @return array
     */
    public function getRoles(): array;

    /**
     * Set entity roles
     * @param array $roles
     * @return $this
     */
    public function setRoles(array $roles): self;

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

    /**
     * Check if token belongs only to local datacenter
     * @return bool
     */
    public function isLocal(): bool;

    /**
     * Set tokens `local` status
     * @param bool $local
     * @return $this
     */
    public function setLocal(bool $local = false): self;
}
