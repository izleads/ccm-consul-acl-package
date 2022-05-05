<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\List;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use ConsulConfigManager\Consul\ACL\Interfaces\TokenRepositoryInterface;

/**
 * Class TokenListInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\List
 */
class TokenListInteractor implements TokenListInputPort
{
    /**
     * Output port instance
     * @var TokenListOutputPort
     */
    private TokenListOutputPort $output;

    /**
     * Repository instance
     * @var TokenRepositoryInterface
     */
    private TokenRepositoryInterface $repository;

    /**
     * TokenListInteractor constructor.
     * @param TokenListOutputPort $output
     * @param TokenRepositoryInterface $repository
     * @return void
     */
    public function __construct(TokenListOutputPort $output, TokenRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function list(TokenListRequestModel $requestModel): ViewModel
    {
        try {
            $tokens = $this->repository->all([
                'id', 'uuid',
                'description', 'local',
                'created_at', 'updated_at',
            ])->toArray();
            return $this->output->list(new TokenListResponseModel($tokens));
            // @codeCoverageIgnoreStart
        } catch (Throwable $exception) {
            return $this->output->internalServerError(new TokenListResponseModel(), $exception);
        }
        // @codeCoverageIgnoreEnd
    }
}
