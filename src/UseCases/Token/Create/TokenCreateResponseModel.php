<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Create;

use ConsulConfigManager\Consul\ACL\Interfaces\TokenInterface;

/**
 * Class TokenCreateResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Create
 */
class TokenCreateResponseModel
{
    /**
     * Entity instance
     * @var TokenInterface|null
     */
    private ?TokenInterface $entity;

    /**
     * TokenCreateResponseModel constructor.
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
