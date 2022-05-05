<?php

namespace ConsulConfigManager\Consul\ACL\Repositories;

use Throwable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use ConsulConfigManager\Consul\ACL\Models\Role;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleInterface;
use ConsulConfigManager\Consul\ACL\AggregateRoots\RoleAggregateRoot;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleRepositoryInterface;

/**
 * Class RoleRepository
 * @package ConsulConfigManager\Consul\ACL\Repositories
 */
class RoleRepository implements RoleRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function all(array $columns = ['*']): Collection
    {
        return Role::all($columns);
    }

    /**
     * @inheritDoc
     */
    public function find(string $id, array $columns = ['*']): RoleInterface|null
    {
        return $this->findBy('id', $id, $columns);
    }

    /**
     * @inheritDoc
     */
    public function findOrFail(string $id, array $columns = ['*']): RoleInterface
    {
        return $this->findByOrFail('id', $id, $columns);
    }

    /**
     * @inheritDoc
     */
    public function findBy(string $field, string $value, array $columns = ['*']): RoleInterface|null
    {
        return Role::where($field, '=', $value)->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function findByOrFail(string $field, string $value, array $columns = ['*']): RoleInterface
    {
        return Role::where($field, '=', $value)->firstOrFail($columns);
    }

    /**
     * @inheritDoc
     */
    public function findByMany(array $fields, string $value, array $columns = ['*']): RoleInterface|null
    {
        $query = Role::query();
        foreach ($fields as $index => $field) {
            if ($index === 0) {
                $query = $query->where($field, '=', $value);
            } else {
                $query = $query->orWhere($field, '=', $value);
            }
        }
        return $query->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function findByManyOrFail(array $fields, string $value, array $columns = ['*']): RoleInterface
    {
        $query = Role::query();
        foreach ($fields as $index => $field) {
            if ($index === 0) {
                $query = $query->where($field, '=', $value);
            } else {
                $query = $query->orWhere($field, '=', $value);
            }
        }
        return $query->firstOrFail($columns);
    }

    /**
     * @inheritDoc
     */
    public function create(string $id, string $name, string $description, array $policies): RoleInterface
    {
        $uuid = Str::uuid()->toString();
        RoleAggregateRoot::retrieve($uuid)
            ->createEntity($id, $name, $description, $policies)
            ->persist();
        return Role::uuid($uuid);
    }

    /**
     * @inheritDoc
     */
    public function update(string $id, string $name, string $description, array $policies): RoleInterface
    {
        $model = $this->findOrFail($id, ['uuid']);
        RoleAggregateRoot::retrieve($model->getUuid())
            ->updateEntity($name, $description, $policies)
            ->persist();
        return Role::uuid($model->getUuid());
    }

    /**
     * @inheritDoc
     */
    public function delete(string $id, bool $forceDelete = false): bool
    {
        try {
            $model = $this->findOrFail($id, ['uuid']);
            RoleAggregateRoot::retrieve($model->getUuid())
                ->deleteEntity()
                ->persist();
            return true;
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function forceDelete(string $id): bool
    {
        return $this->delete($id, true);
    }
}
