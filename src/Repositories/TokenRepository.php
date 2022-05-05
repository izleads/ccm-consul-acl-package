<?php

namespace ConsulConfigManager\Consul\ACL\Repositories;

use Throwable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use ConsulConfigManager\Consul\ACL\Models\Token;
use ConsulConfigManager\Consul\ACL\Interfaces\TokenInterface;
use ConsulConfigManager\Consul\ACL\AggregateRoots\TokenAggregateRoot;
use ConsulConfigManager\Consul\ACL\Interfaces\TokenRepositoryInterface;

/**
 * Class TokenRepository
 * @package ConsulConfigManager\Consul\ACL\Repositories
 */
class TokenRepository implements TokenRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function all(array $columns = ['*']): Collection
    {
        return Token::all($columns);
    }

    /**
     * @inheritDoc
     */
    public function find(string $id, array $columns = ['*']): TokenInterface|null
    {
        return $this->findBy('id', $id, $columns);
    }

    /**
     * @inheritDoc
     */
    public function findOrFail(string $id, array $columns = ['*']): TokenInterface
    {
        return $this->findByOrFail('id', $id, $columns);
    }

    /**
     * @inheritDoc
     */
    public function findBy(string $field, string $value, array $columns = ['*']): TokenInterface|null
    {
        return Token::where($field, '=', $value)->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function findByOrFail(string $field, string $value, array $columns = ['*']): TokenInterface
    {
        return Token::where($field, '=', $value)->firstOrFail($columns);
    }

    /**
     * @inheritDoc
     */
    public function findByMany(array $fields, string $value, array $columns = ['*']): TokenInterface|null
    {
        $query = Token::query();
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
    public function findByManyOrFail(array $fields, string $value, array $columns = ['*']): TokenInterface
    {
        $query = Token::query();
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
    public function create(string $id, string $secret, string $description, array $roles = [], array $policies = [], bool $local = false): TokenInterface
    {
        $uuid = Str::uuid()->toString();
        TokenAggregateRoot::retrieve($uuid)
            ->createEntity(
                $id,
                $secret,
                $description,
                $roles,
                $policies,
                $local,
            )
            ->persist();
        return Token::uuid($uuid);
    }

    /**
     * @inheritDoc
     */
    public function update(string $id, string $secret, string $description, array $roles = [], array $policies = [], bool $local = false): TokenInterface
    {
        $model = $this->findOrFail($id, ['uuid']);
        TokenAggregateRoot::retrieve($model->getUuid())
            ->updateEntity(
                $secret,
                $description,
                $roles,
                $policies,
                $local,
            )
            ->persist();
        return Token::uuid($model->getUuid());
    }

    /**
     * @inheritDoc
     */
    public function delete(string $id, bool $forceDelete = false): bool
    {
        try {
            $model = $this->findOrFail($id, ['uuid']);
            TokenAggregateRoot::retrieve($model->getUuid())
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
