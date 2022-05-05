<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete;

use ConsulConfigManager\Consul\ACL\Interfaces\PolicyInterface;

/**
 * Class PolicyDeleteResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Delete
 */
class PolicyDeleteResponseModel
{
    /**
     * Entity instance
     * @var PolicyInterface|null
     */
    private ?PolicyInterface $entity;

    /**
     * PolicyDeleteResponseModel constructor.
     * @param PolicyInterface|null $entity
     * @return void
     */
    public function __construct(?PolicyInterface $entity = null)
    {
        $this->entity = $entity;
    }

    /**
     * Delete entity
     * @return PolicyInterface|null
     */
    public function getEntity(): ?PolicyInterface
    {
        return $this->entity;
    }
}
