<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Interface PolicyAutocompleteOutputPort
 * @package ConsulConfigManager\Consul\ACL\UseCases\Policy\Autocomplete
 */
interface PolicyAutocompleteOutputPort
{
    /**
     * Output port for "autocomplete"
     * @param PolicyAutocompleteResponseModel $responseModel
     * @return ViewModel
     */
    public function autocomplete(PolicyAutocompleteResponseModel $responseModel): ViewModel;

    /**
     * Output port for "internal server error"
     * @param PolicyAutocompleteResponseModel $responseModel
     * @param Throwable $exception
     * @return ViewModel
     */
    public function internalServerError(PolicyAutocompleteResponseModel $responseModel, Throwable $exception): ViewModel;
}
