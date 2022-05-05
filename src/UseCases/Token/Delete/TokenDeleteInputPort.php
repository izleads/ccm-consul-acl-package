<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Delete;

use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface TokenDeleteInputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Delete
 */
interface TokenDeleteInputPort
{
    /**
     * Delete token
     * @param TokenDeleteRequestModel $requestModel
     * @return ViewModel
     */
    public function delete(TokenDeleteRequestModel $requestModel): ViewModel;
}
