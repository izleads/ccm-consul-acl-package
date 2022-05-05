<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Delete;

use ConsulConfigManager\Consul\ACL\Interfaces\TokenInterface;

/**
 * Class TokenDeleteResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Delete
 */
class TokenDeleteResponseModel
{
    /**
     * Entity instance
     * @var TokenInterface|null
     */
    private ?TokenInterface $entity;

    /**
     * TokenDeleteResponseModel constructor.
     * @param TokenInterface|null $entity
     * @return void
     */
    public function __construct(?TokenInterface $entity = null)
    {
        $this->entity = $entity;
    }

    /**
     * Delete entity
     * @return TokenInterface|null
     */
    public function getEntity(): ?TokenInterface
    {
        return $this->entity;
    }
}
