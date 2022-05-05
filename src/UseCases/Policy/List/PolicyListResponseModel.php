<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\List;

/**
 * Class PolicyListResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\List
 */
class PolicyListResponseModel
{
    /**
     * List of policies
     * @var array
     */
    private array $policies;

    /**
     * PolicyListResponseModel constructor.
     * @param array $policies
     * @return void
     */
    public function __construct(array $policies = [])
    {
        $this->policies = $policies;
    }

    /**
     * Get list of policies
     * @return array
     */
    public function getPolicies(): array
    {
        return $this->policies;
    }
}
