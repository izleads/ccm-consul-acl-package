<?php

namespace ConsulConfigManager\Consul\ACL\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Interface TokenRepositoryInterface
 * @package ConsulConfigManager\Consul\ACL\Interfaces
 */
interface TokenRepositoryInterface
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
     * @return TokenInterface|null
     */
    public function find(string $id, array $columns = ['*']): TokenInterface|null;

    /**
     * Find entity or fail and throw exception
     * @param string $id
     * @param array|string[] $columns
     * @throws ModelNotFoundException
     * @return TokenInterface
     */
    public function findOrFail(string $id, array $columns = ['*']): TokenInterface;

    /**
     * Find entity by specified field
     * @param string $field
     * @param string $value
     * @param array|string[] $columns
     * @return TokenInterface|null
     */
    public function findBy(string $field, string $value, array $columns = ['*']): TokenInterface|null;

    /**
     * Find entity by specified field or throw exception
     * @param string $field
     * @param string $value
     * @param array|string[] $columns
     * @throws ModelNotFoundException
     * @return TokenInterface
     */
    public function findByOrFail(string $field, string $value, array $columns = ['*']): TokenInterface;

    /**
     * Find entity while using multiple fields to perform search
     * @param array $fields
     * @param string $value
     * @param array|string[] $columns
     * @return TokenInterface|null
     */
    public function findByMany(array $fields, string $value, array $columns = ['*']): TokenInterface|null;

    /**
     * Find entity while using multiple fields to perform search or throw exception
     * @param array $fields
     * @param string $value
     * @param array|string[] $columns
     * @throws ModelNotFoundException
     * @return TokenInterface
     */
    public function findByManyOrFail(array $fields, string $value, array $columns = ['*']): TokenInterface;

    /**
     * Create new token
     * @param string $id
     * @param string $secret
     * @param string $description
     * @param array $roles
     * @param array $policies
     * @param bool $local
     * @return TokenInterface
     */
    public function create(string $id, string $secret, string $description, array $roles = [], array $policies = [], bool $local = false): TokenInterface;

    /**
     * Update existing token
     * @param string $id
     * @param string $secret
     * @param string $description
     * @param array $roles
     * @param array $policies
     * @param bool $local
     * @return TokenInterface
     */
    public function update(string $id, string $secret, string $description, array $roles = [], array $policies = [], bool $local = false): TokenInterface;

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
