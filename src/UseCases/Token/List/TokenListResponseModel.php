<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\List;

/**
 * Class TokenListResponseModel
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\List
 */
class TokenListResponseModel
{
    /**
     * List of tokens
     * @var array
     */
    private array $tokens;

    /**
     * TokenListResponseModel constructor.
     * @param array $tokens
     * @return void
     */
    public function __construct(array $tokens = [])
    {
        $this->tokens = $tokens;
    }

    /**
     * Get list of tokens
     * @return array
     */
    public function getTokens(): array
    {
        return $this->tokens;
    }
}
