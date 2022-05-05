<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Get;

use ConsulConfigManager\Consul\ACL\Interfaces\TokenInterface;

/**
 * Class TokenGetResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Get
 */
class TokenGetResponseModel
{
    /**
     * Entity instance
     * @var TokenInterface|null
     */
    private ?TokenInterface $entity;

    /**
     * TokenGetResponseModel constructor.
     * @param TokenInterface|null $entity
     * @return void
     */
    public function __construct(?TokenInterface $entity = null)
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
