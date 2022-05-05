<?php

namespace ConsulConfigManager\Consul\ACL\Events\Policy;

use ConsulConfigManager\Consul\ACL\Events\AbstractEvent;
use ConsulConfigManager\Users\Interfaces\UserInterface;

/**
 * Class PolicyCreated
 * @package ConsulConfigManager\Consul\ACL\Events\Policy
 */
class PolicyCreated extends AbstractEvent
{
    /**
     * Policy id
     * @var string
     */
    private string $id;

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
     * PolicyCreated constructor.
     * @param string $id
     * @param string $name
     * @param string $description
     * @param string $rules
     * @param UserInterface|int|null $user
     * @return void
     */
    public function __construct(string $id, string $name, string $description, string $rules, UserInterface|int|null $user = null)
    {
        $this->id = $id;
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
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get policy name
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
