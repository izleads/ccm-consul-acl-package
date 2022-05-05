<?php

namespace ConsulConfigManager\Consul\ACL\Events\Policy;

use ConsulConfigManager\Consul\ACL\Events\AbstractEvent;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class PolicyUpdated
 * @package ConsulConfigManager\Consul\ACL\Events\Policy
 */
class PolicyUpdated extends AbstractEvent
{
    /**
     * Policy name
     * @var string
     */
    private string $name;

    /**
     * Policy description
     * @var string
     */
    private string $description;

    /**
     * Policy rules
     * @var string
     */
    private string $rules;

    /**
     * PolicyUpdated constructor.
     * @param string $name
     * @param string $description
     * @param string $rules
     * @param UserInterface|int|null $user
     */
    public function __construct(string $name, string $description, string $rules, UserInterface|int|null $user = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->rules = $rules;
        $this->user = $user;
        parent::__construct();
    }

    /**
     * Get policy id
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get policy description
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get policy rules
     * @return string
     */
    public function getRules(): string
    {
        return $this->rules;
    }
}
