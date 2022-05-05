<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Create;

use ConsulConfigManager\Consul\ACL\Interfaces\PolicyInterface;

/**
 * Class PolicyCreateResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Create
 */
class PolicyCreateResponseModel
{
    /**
     * Entity instance
     * @var PolicyInterface|null
     */
    private ?PolicyInterface $entity;

    /**
     * PolicyCreateResponseModel constructor.
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
