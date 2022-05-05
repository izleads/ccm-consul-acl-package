<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Get;

use ConsulConfigManager\Consul\ACL\Interfaces\PolicyInterface;

/**
 * Class PolicyGetResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Get
 */
class PolicyGetResponseModel
{
    /**
     * Entity instance
     * @var PolicyInterface|null
     */
    private ?PolicyInterface $entity;

    /**
     * PolicyGetResponseModel constructor.
     * @param PolicyInterface|null $entity
     * @return void
     */
    public function __construct(?PolicyInterface $entity = null)
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
