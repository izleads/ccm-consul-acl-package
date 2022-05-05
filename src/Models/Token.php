<?php

namespace ConsulConfigManager\Consul\ACL\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use ConsulConfigManager\Consul\ACL\Factories\TokenFactory;
use ConsulConfigManager\Consul\ACL\Interfaces\TokenInterface;

/**
 * Class Policy
 * @package ConsulConfigManager\Consul\ACL\Models
 */
class Token extends Model implements TokenInterface
{
    use SoftDeletes;
    use HasFactory;

    /**
     * @inheritDoc
     */
    public $table = 'consul_tokens';

    /**
     * @inheritDoc
     */
    protected $fillable = [
        'id',
        'uuid',
        'secret',
        'description',
        'roles',
        'policies',
    ];

    /**
     * @inheritDoc
     */
    protected $guarded = [];

    /**
     * @inheritDoc
     */
    protected $hidden = [];

    /**
     * @inheritDoc
     */
    protected $casts = [
        'id'            =>  'string',
        'uuid'          =>  'string',
        'secret'        =>  'string',
        'description'   =>  'string',
        'roles'         =>  'array',
        'policies'      =>  'array',
        'local'         =>  'boolean',
    ];

    /**
     * @inheritDoc
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @inheritDoc
     */
    protected $with = [];

    /**
     * @inheritDoc
     */
    public static function uuid(string $uuid, bool $withTrashed = false): TokenInterface|null
    {
        $query = static::where('uuid', '=', $uuid);
        if ($withTrashed) {
            return $query->withTrashed()->first();
        }
        return $query->first();
    }

    /**
     * @inheritDoc
     */
    protected static function newFactory(): Factory
    {
        return TokenFactory::new();
    }

    /**
     * @inheritDoc
     */
    public function getID(): string
    {
        return (string) $this->attributes['id'];
    }

    /**
     * @inheritDoc
     */
    public function setID(string $id): TokenInterface
    {
        $this->attributes['id'] = (string) $id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getUuid(): string
    {
        return (string) $this->attributes['uuid'];
    }

    /**
     * @inheritDoc
     */
    public function setUuid(string $uuid): TokenInterface
    {
        $this->attributes['uuid'] = (string) $uuid;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSecret(): string
    {
        return (string) $this->attributes['secret'];
    }

    /**
     * @inheritDoc
     */
    public function setSecret(string $secret): TokenInterface
    {
        $this->attributes['secret'] = (string) $secret;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return (string) $this->attributes['description'];
    }

    /**
     * @inheritDoc
     */
    public function setDescription(string $description): TokenInterface
    {
        $this->attributes['description'] = (string) $description;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles(): array
    {
        return json_decode($this->attributes['roles'], true);
    }

    /**
     * @inheritDoc
     */
    public function setRoles(array $roles): TokenInterface
    {
        $this->attributes['roles'] = json_encode($roles);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getPolicies(): array
    {
        return json_decode($this->attributes['policies'], true);
    }

    /**
     * @inheritDoc
     */
    public function setPolicies(array $policies): TokenInterface
    {
        $this->attributes['policies'] = json_encode($policies);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isLocal(): bool
    {
        return (bool) $this->attributes['local'];
    }

    /**
     * @inheritDoc
     */
    public function setLocal(bool $local = false): TokenInterface
    {
        $this->attributes['local'] = (bool) $local;
        return $this;
    }
}
