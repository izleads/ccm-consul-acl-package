<?php

namespace ConsulConfigManager\Consul\ACL\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use ConsulConfigManager\Consul\ACL\Factories\PolicyFactory;
use ConsulConfigManager\Consul\ACL\Interfaces\PolicyInterface;

/**
 * Class Policy
 * @package ConsulConfigManager\Consul\ACL\Models
 */
class Policy extends Model implements PolicyInterface
{
    use SoftDeletes;
    use HasFactory;

    /**
     * @inheritDoc
     */
    public $table = 'consul_policies';

    /**
     * @inheritDoc
     */
    protected $fillable = [
        'id',
        'uuid',
        'name',
        'description',
        'rules',
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
        'rules'         =>  'string',
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
    public static function uuid(string $uuid, bool $withTrashed = false): PolicyInterface|null
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
        return PolicyFactory::new();
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
    public function setID(string $id): PolicyInterface
    {
        $this->attributes['id'] = $id;
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
    public function setUuid(string $uuid): PolicyInterface
    {
        $this->attributes['uuid'] = $uuid;
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
    public function setName(string $name): PolicyInterface
    {
        $this->attributes['name'] = $name;
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
    public function setDescription(string $description): PolicyInterface
    {
        $this->attributes['description'] = $description;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRules(): string
    {
        return (string) $this->attributes['rules'];
    }

    /**
     * @inheritDoc
     */
    public function setRules(string $rules): PolicyInterface
    {
        $this->attributes['rules'] = $rules;
        return $this;
    }
}
