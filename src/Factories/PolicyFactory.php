<?php

namespace ConsulConfigManager\Consul\ACL\Factories;

use Illuminate\Support\Carbon;
use ConsulConfigManager\Consul\ACL\Models\Policy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class PolicyFactory
 * @package ConsulConfigManager\Consul\ACL\Factories
 */
class PolicyFactory extends Factory
{
    /**
     * @inheritDoc
     */
    protected $model = Policy::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        return [
            'id'            =>  $this->faker->uuid(),
            'uuid'          =>  $this->faker->uuid(),
            'name'          =>  strtolower($this->faker->firstName()) . '_' . strtolower($this->faker->lastName),
            'description'   =>  $this->faker->text(),
            'rules'         =>  '',
            'created_at'    =>  Carbon::now(),
            'updated_at'    =>  Carbon::now(),
            'deleted_at'    =>  null,
        ];
    }
}
