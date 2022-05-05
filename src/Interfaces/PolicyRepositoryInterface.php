<?php

namespace ConsulConfigManager\Consul\ACL\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Interface PolicyRepositoryInterface
 * @package ConsulConfigManager\Consul\ACL\Interfaces
 */
interface PolicyRepositoryInterface
{
    /**
     * Get list of all entries from database
     * @param array|string[] $columns
     *
     * @return Collection
     */
    public function all(array $columns = ['*']): Collection;

    /**
     * Find entity
     * @param string $id
     * @param array|string[] $columns
     * @return PolicyInterface|null
     */
    public function find(string $id, array $columns = ['*']): PolicyInterface|null;

    /**
     * Find entity or fail and throw exception
     * @param string $id
     * @param array|string[] $columns
     * @throws ModelNotFoundException
     * @return PolicyInterface
     */
    public function findOrFail(string $id, array $columns = ['*']): PolicyInterface;

    /**
     * Find entity by specified field
     * @param string $field
     * @param string $value
     * @param array|string[] $columns
     * @return PolicyInterface|null
     */
    public function findBy(string $field, string $value, array $columns = ['*']): PolicyInterface|null;

    /**
     * Find entity by specified field or throw exception
     * @param string $field
     * @param string $value
     * @param array|string[] $columns
     * @throws ModelNotFoundException
     * @return PolicyInterface
     */
    public function findByOrFail(string $field, string $value, array $columns = ['*']): PolicyInterface;

    /**
     * Find entity while using multiple fields to perform search
     * @param array $fields
     * @param string $value
     * @param array|string[] $columns
     * @return PolicyInterface|null
     */
    public function findByMany(array $fields, string $value, array $columns = ['*']): PolicyInterface|null;

    /**
     * Find entity while using multiple fields to perform search or throw exception
     * @param array $fields
     * @param string $value
     * @param array|string[] $columns
     * @throws ModelNotFoundException
     * @return PolicyInterface
     */
    public function findByManyOrFail(array $fields, string $value, array $columns = ['*']): PolicyInterface;

    /**
     * Create new policy
     * @param string $id
     * @param string $name
     * @param string $description
     * @param string $rules
     * @return PolicyInterface
     */
    public function create(string $id, string $name, string $description, string $rules): PolicyInterface;

    /**
     * Update existing policy
     * @param string $id
     * @param string $name
     * @param string $description
     * @param string $rules
     * @return PolicyInterface
     */
    public function update(string $id, string $name, string $description, string $rules): PolicyInterface;

    /**
     * Delete entity
     * @param string $id
     * @param bool $forceDelete
     * @return bool
     */
    public function delete(string $id, bool $forceDelete = false): bool;

    /**
     * Force entity deletion
     * @param string $id
     * @return bool
     */
    public function forceDelete(string $id): bool;
}
