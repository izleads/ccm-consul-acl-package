<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Update;

use ConsulConfigManager\Consul\ACL\Interfaces\PolicyInterface;

/**
 * Class PolicyUpdateResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Update
 */
class PolicyUpdateResponseModel
{
    /**
     * Entity instance
     * @var PolicyInterface|null
     */
    private ?PolicyInterface $entity;

    /**
     * PolicyUpdateResponseModel constructor.
     * @param PolicyInterface|null $entity
     * @return void
     */
    public function __construct(PolicyInterface $entity = null)
    {
        $this->entity = $entity;
    }

    /**
     * Get entity
     * @return PolicyInterface|null
     */
    public function getEntity(): ?PolicyInterface
    {
        return $this->entity;
    }
}
