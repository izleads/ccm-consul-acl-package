<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Update;

use ConsulConfigManager\Consul\ACL\Interfaces\TokenInterface;

/**
 * Class TokenUpdateResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Update
 */
class TokenUpdateResponseModel
{
    /**
     * Entity instance
     * @var TokenInterface|null
     */
    private ?TokenInterface $entity;

    /**
     * TokenUpdateResponseModel constructor.
     * @param TokenInterface|null $entity
     * @return void
     */
    public function __construct(TokenInterface $entity = null)
    {
        $this->entity = $entity;
    }

    /**
     * Get entity
     * @return TokenInterface|null
     */
    public function getEntity(): ?TokenInterface
    {
        return $this->entity;
    }
}
