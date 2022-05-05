<?php

namespace ConsulConfigManager\Consul\ACL\Commands;

use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Consul\ACL\Interfaces\PolicyRepositoryInterface;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class PolicySync
 * @package ConsulConfigManager\Consul\ACL\Commands
 */
class PolicySync extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consul:acl:policy:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize ACL Policies with Consul';

    /**
     * Policy repository instance
     * @var PolicyRepositoryInterface
     */
    private PolicyRepositoryInterface $repository;

    /**
     * Access Control List service instance
     * @var AccessControlListServiceInterface
     */
    private AccessControlListServiceInterface $service;

    /**
     * PolicySync constructor.
     * @param PolicyRepositoryInterface $repository
     * @param AccessControlListServiceInterface $service
     * @return void
     */
    public function __construct(PolicyRepositoryInterface $repository, AccessControlListServiceInterface $service)
    {
        $this->repository = $repository;
        $this->service = $service;
        parent::__construct();
    }

    /**
     * Execute console command.
     * @return int
     * @throws RequestException
     */
    public function handle(): int
    {
        $this->info('Fetching list of policies from Consul server...');
        $policiesList = $this->service->listPolicies();

        $policiesCount = \count($policiesList);
        $this->info('There are total of ' . $policiesCount . ' policies registered with Consul server');

        $policiesStorage = $this->retrievePolicies($policiesList, $policiesCount);
        $this->storePolicies($policiesStorage);

        return 0;
    }

    /**
     * Retrieve data for policies from Consul server
     * @param array $policiesList
     * @param int $policiesCount
     * @return array
     * @throws RequestException
     */
    private function retrievePolicies(array $policiesList, int $policiesCount): array {
        $policiesStorage = [];
        $this->info('Retrieving values for ' . $policiesCount . ' policies...');
        $progress = $this->output->createProgressBar($policiesCount);
        $progress->start();

        foreach ($policiesList as $policyData) {
            $policy = $this->service->readPolicy(Arr::get($policyData, 'id'));
            $policiesStorage[trim(Arr::get($policy, 'id'))] = Arr::except($policy, [
                'id', 'hash', 'create_index', 'modify_index',
            ]);
            $progress->advance();
        }

        $progress->finish();
        $this->newLine(2);
        $this->info('Successfully retrieved values for ' . $policiesCount . 'policies');
        return $policiesStorage;
    }

    /**
     * Store retrieved policies in the database
     * @param array $policiesStorage
     * @return void
     */
    private function storePolicies(array $policiesStorage): void {
        $this->newLine(2);
        foreach ($policiesStorage as $id => $value) {
            $model = $this->repository->find($id);
            if ($model === null) {
                $this->repository->create(
                    $id,
                    Arr::get($value, 'name'),
                    Arr::get($value, 'description'),
                    Arr::get($value, 'rules'),
                );
                $this->info(sprintf('[%s] %s - created', $id, Arr::get($value, 'name')));
            } else {
                $isSameName = $model->getName() === Arr::get($value, 'name');
                $isSameDescription = $model->getDescription() === Arr::get($value, 'description');
                $isSameRules = $model->getRules() === Arr::get($value, 'rules');

                if (!$isSameName || !$isSameDescription || !$isSameRules) {
                    $this->repository->create(
                        $id,
                        Arr::get($value, 'name'),
                        Arr::get($value, 'description'),
                        Arr::get($value, 'rules'),
                    );
                    $this->info(sprintf('[%s] %s - updated', $id, $model->getName()));
                } else {
                    $this->info(sprintf('[%s] %s - not changed', $id, $model->getName()));
                }
            }
        }
    }

}
