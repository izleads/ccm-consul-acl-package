<?php

namespace ConsulConfigManager\Consul\ACL\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use ConsulConfigManager\Consul\ACL\Factories\RoleFactory;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleInterface;

/**
 * Class Policy
 * @package ConsulConfigManager\Consul\ACL\Models
 */
class Role extends Model implements RoleInterface
{
    use SoftDeletes;
    use HasFactory;

    /**
     * @inheritDoc
     */
    public $table = 'consul_roles';

    /**
     * @inheritDoc
     */
    protected $fillable = [
        'id',
        'uuid',
        'name',
        'description',
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
        'name'          =>  'string',
        'description'   =>  'string',
        'policies'      =>  'array',
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
    public static function uuid(string $uuid, bool $withTrashed = false): RoleInterface|null
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
        return RoleFactory::new();
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
    public function setID(string $id): RoleInterface
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
    public function setUuid(string $uuid): RoleInterface
    {
        $this->attributes['uuid'] = (string) $uuid;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return (string) $this->attributes['name'];
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): RoleInterface
    {
        $this->attributes['name'] = (string) $name;
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
    public function setDescription(string $description): RoleInterface
    {
        $this->attributes['description'] = (string) $description;
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
    public function setPolicies(array $policies): RoleInterface
    {
        $this->attributes['policies'] = json_encode($policies);
        return $this;
    }
}
