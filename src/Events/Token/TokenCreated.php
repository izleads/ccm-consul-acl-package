<?php

namespace ConsulConfigManager\Consul\ACL\Events\Token;

use ConsulConfigManager\Consul\ACL\Events\AbstractEvent;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class TokenCreated
 * @package ConsulConfigManager\Consul\ACL\Events\Token
 */
class TokenCreated extends AbstractEvent
{
    /**
     * Token accessor id
     * @var string
     */
    private string $id;

    /**
     * Token secret id
     * @var string
     */
    private string $secret;

    /**
     * Token description
     * @var string
     */
    private string $description;

    /**
     * Token roles
     * @var array
     */
    private array $roles;

    /**
     * Token policies
     * @var array
     */
    private array $policies;

    /**
     * Determines if token belongs to local datacenter
     * @var bool
     */
    private bool $local;

    /**
     * TokenCreated constructor.
     * @param string $id
     * @param string $secret
     * @param string $description
     * @param array $roles
     * @param array $policies
     * @param bool $local
     * @param UserInterface|int|null $user
     * @return void
     */
    public function __construct(string $id, string $secret, string $description, array $roles, array $policies, bool $local, UserInterface|int|null $user = null)
    {
        $this->id = $id;
        $this->secret = $secret;
        $this->description = $description;
        $this->roles = $roles;
        $this->policies = $policies;
        $this->local = $local;
        $this->user = $user;
        parent::__construct();
    }

    /**
     * Get token accessor id
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get token secret id
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * Get token description
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get token roles
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * Get token policies
     * @return array
     */
    public function getPolicies(): array
    {
        return $this->policies;
    }

    /**
     * Check if token belongs only to local datacenter
     * @return bool
     */
    public function isLocal(): bool
    {
        return $this->local;
    }
}
