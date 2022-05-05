<?php

namespace ConsulConfigManager\Consul\ACL\Factories;

use Illuminate\Support\Carbon;
use ConsulConfigManager\Consul\ACL\Models\Token;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class TokenFactory
 * @package ConsulConfigManager\Consul\ACL\Factories
 */
class TokenFactory extends Factory
{
    /**
     * @inheritDoc
     */
    protected $model = Token::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        return [
            'id'            =>  $this->faker->uuid(),
            'uuid'          =>  $this->faker->uuid(),
            'secret'        =>  $this->faker->uuid(),
            'description'   =>  $this->faker->text(),
            'roles'         =>  [],
            'policies'      =>  [],
            'created_at'    =>  Carbon::now(),
            'updated_at'    =>  Carbon::now(),
            'deleted_at'    =>  null,
        ];
    }
}
