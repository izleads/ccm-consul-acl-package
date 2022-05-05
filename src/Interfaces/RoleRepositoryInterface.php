<?php

namespace ConsulConfigManager\Consul\ACL\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Interface RoleRepositoryInterface
 * @package ConsulConfigManager\Consul\ACL\Interfaces
 */
interface RoleRepositoryInterface
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
     * @return RoleInterface|null
     */
    public function find(string $id, array $columns = ['*']): RoleInterface|null;

    /**
     * Find entity or fail and throw exception
     * @param string $id
     * @param array|string[] $columns
     * @throws ModelNotFoundException
     * @return RoleInterface
     */
    public function findOrFail(string $id, array $columns = ['*']): RoleInterface;

    /**
     * Find entity by specified field
     * @param string $field
     * @param string $value
     * @param array|string[] $columns
     * @return RoleInterface|null
     */
    public function findBy(string $field, string $value, array $columns = ['*']): RoleInterface|null;

    /**
     * Find entity by specified field or throw exception
     * @param string $field
     * @param string $value
     * @param array|string[] $columns
     * @throws ModelNotFoundException
     * @return RoleInterface
     */
    public function findByOrFail(string $field, string $value, array $columns = ['*']): RoleInterface;

    /**
     * Find entity while using multiple fields to perform search
     * @param array $fields
     * @param string $value
     * @param array|string[] $columns
     * @return RoleInterface|null
     */
    public function findByMany(array $fields, string $value, array $columns = ['*']): RoleInterface|null;

    /**
     * Find entity while using multiple fields to perform search or throw exception
     * @param array $fields
     * @param string $value
     * @param array|string[] $columns
     * @throws ModelNotFoundException
     * @return RoleInterface
     */
    public function findByManyOrFail(array $fields, string $value, array $columns = ['*']): RoleInterface;

    /**
     * Create new role
     * @param string $id
     * @param string $name
     * @param string $description
     * @param array $policies
     * @return RoleInterface
     */
    public function create(string $id, string $name, string $description, array $policies): RoleInterface;

    /**
     * Update existing role
     * @param string $id
     * @param string $name
     * @param string $description
     * @param array $policies
     * @return RoleInterface
     */
    public function update(string $id, string $name, string $description, array $policies): RoleInterface;

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
