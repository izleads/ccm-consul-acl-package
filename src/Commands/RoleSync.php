<?php

namespace ConsulConfigManager\Consul\ACL\Commands;

use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleRepositoryInterface;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class RoleSync
 * @package ConsulConfigManager\Consul\ACL\Commands
 */
class RoleSync extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consul:acl:role:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize ACL Roles with Consul';

    /**
     * Role repository instance
     * @var RoleRepositoryInterface
     */
    private RoleRepositoryInterface $repository;

    /**
     * Access Control List service instance
     * @var AccessControlListServiceInterface
     */
    private AccessControlListServiceInterface $service;

    /**
     * RoleSync constructor.
     * @param RoleRepositoryInterface $repository
     * @param AccessControlListServiceInterface $service
     * @return void
     */
    public function __construct(RoleRepositoryInterface $repository, AccessControlListServiceInterface $service)
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
        $this->info('Fetching list of roles from Consul server...');
        $rolesList = $this->service->listRoles();

        $rolesCount = \count($rolesList);
        $this->info('There are total of ' . $rolesCount . ' roles registered with Consul server');

        $rolesStorage = $this->retrieveRoles($rolesList, $rolesCount);

        $this->storeRoles($rolesStorage);

        return 0;
    }

    /**
     * Retrieve data for roles from Consul server
     * @param array $rolesList
     * @param int $rolesCount
     * @return array
     * @throws RequestException
     */
    private function retrieveRoles(array $rolesList, int $rolesCount): array {
        $rolesStorage = [];
        $this->info('Retrieving values for ' . $rolesCount . ' roles...');
        $progress = $this->output->createProgressBar($rolesCount);
        $progress->start();

        foreach ($rolesList as $roleData) {
            $role = $this->service->readRole(Arr::get($roleData, 'id'));
            $rolesStorage[trim(Arr::get($role, 'id'))] = Arr::except($role, [
                'id', 'hash', 'create_index', 'modify_index',
            ]);
            $progress->advance();
        }

        $progress->finish();
        $this->newLine(2);
        $this->info('Successfully retrieved values for ' . $rolesCount . 'roles');
        return $rolesStorage;
    }

    /**
     * Store retrieved roles in the database
     * @param array $rolesStorage
     * @return void
     */
    private function storeRoles(array $rolesStorage): void {
        $this->newLine(2);
        foreach ($rolesStorage as $id => $value) {
            $model = $this->repository->find($id);
            if ($model === null) {
                $this->repository->create(
                    $id,
                    Arr::get($value, 'name'),
                    Arr::get($value, 'description'),
                    Arr::get($value, 'policies', []),
                );
                $this->info(sprintf('[%s] %s - created', $id, Arr::get($value, 'name')));
            } else {
                $isSameName = $model->getName() === Arr::get($value, 'name');
                $isSameDescription = $model->getDescription() === Arr::get($value, 'description');
                $isSamePolicies = $model->getPolicies() === Arr::get($value, 'policies');

                if (!$isSameName || !$isSameDescription || !$isSamePolicies) {
                    $this->repository->create(
                        $id,
                        Arr::get($value, 'name'),
                        Arr::get($value, 'description'),
                        Arr::get($value, 'policies', []),
                    );
                    $this->info(sprintf('[%s] %s - updated', $id, $model->getName()));
                } else {
                    $this->info(sprintf('[%s] %s - not changed', $id, $model->getName()));
                }
            }
        }
    }

}
