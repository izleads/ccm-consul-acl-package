<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\List;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface TokenListInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\List
 */
interface TokenListInputPort
{
    /**
     * Get list of all ACL tokens
     * @param TokenListRequestModel $requestModel
     * @return ViewModel
     */
    public function list(TokenListRequestModel $requestModel): ViewModel;
}
