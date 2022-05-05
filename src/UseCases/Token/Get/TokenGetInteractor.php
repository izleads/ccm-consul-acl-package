<?php

namespace ConsulConfigManager\Consul\ACL\UseCases\Token\Get;

use Throwable;
use ConsulConfigManager\Domain\Interfaces\ViewModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\ACL\Interfaces\TokenRepositoryInterface;

/**
 * Class TokenGetInteractor
 * @package ConsulConfigManager\Consul\ACL\UseCases\Token\Get
 */
class TokenGetInteractor implements TokenGetInputPort
{
    /**
     * Output port instance
     * @var TokenGetOutputPort
     */
    private TokenGetOutputPort $output;

    /**
     * Repository instance
     * @var TokenRepositoryInterface
     */
    private TokenRepositoryInterface $repository;

    /**
     * TokenGetInteractor constructor.
     * @param TokenGetOutputPort $output
     * @param TokenRepositoryInterface $repository
     * @return void
     */
    public function __construct(TokenGetOutputPort $output, TokenRepositoryInterface $repository)
    {
        $this->output = $output;
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function get(TokenGetRequestModel $requestModel): ViewModel
    {
        $tokenID = $requestModel->getTokenID();
        try {
            $model = $this->repository->findByManyOrFail(['id', 'secret', 'uuid'], $tokenID);
            return $this->output->get(new TokenGetResponseModel($model));
        } catch (Throwable $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return $this->output->notFound(new TokenGetResponseModel());
            }
            // @codeCoverageIgnoreStart
            return $this->output->internalServerError(new TokenGetResponseModel(), $exception);
            // @codeCoverageIgnoreEnd
        }
    }
}
