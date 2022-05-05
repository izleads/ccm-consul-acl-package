<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\Models;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\ACL\Models\Role;
use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleInterface;
use ConsulConfigManager\Consul\ACL\AggregateRoots\RoleAggregateRoot;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleRepositoryInterface;

/**
 * Class RoleTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\Models
 */
class RoleTest extends TestCase
{
    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetIdMethod(array $data): void
    {
        $response = $this->model($data)->getID();
        $this->assertEquals(Arr::get($data, 'id'), $response);
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromSetIdMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setID('0e013a2b-03f6-404d-b8f6-fd186191c145');
        $this->assertEquals('0e013a2b-03f6-404d-b8f6-fd186191c145', $model->getID());
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetUuidMethod(array $data): void
    {
        $response = $this->model($data)->getUuid();
        $this->assertEquals(Arr::get($data, 'uuid'), $response);
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromSetUuidMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setUuid('3227aa96-4559-4d38-bdcd-ab8ee1744fd8');
        $this->assertEquals('3227aa96-4559-4d38-bdcd-ab8ee1744fd8', $model->getUuid());
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetNameMethod(array $data): void
    {
        $response = $this->model($data)->getName();
        $this->assertEquals(Arr::get($data, 'name'), $response);
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromSetNameMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setName('new_example_role');
        $this->assertEquals('new_example_role', $model->getName());
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetDescriptionMethod(array $data): void
    {
        $response = $this->model($data)->getDescription();
        $this->assertEquals(Arr::get($data, 'description'), $response);
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromSetDescriptionMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setDescription('This is new example description.');
        $this->assertEquals('This is new example description.', $model->getDescription());
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetPoliciesMethod(array $data): void
    {
        $response = $this->model($data)->getPolicies();
        $this->assertEquals(Arr::get($data, 'policies'), $response);
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromSetPoliciesMethod(array $data): void
    {
        $model = $this->model($data);
        $model->setPolicies([
            [
                'id'    =>  'new_example_policy',
            ],
        ]);
        $this->assertEquals([
            [
                'id'    =>  'new_example_policy',
            ],
        ], $model->getPolicies());
    }

    /**
     * @param array $data
     *
     * @dataProvider modelDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromUuidMethod(array $data): void
    {
        RoleAggregateRoot::retrieve(Arr::get($data, 'uuid'))
            ->createEntity(
                Arr::get($data, 'id'),
                Arr::get($data, 'name'),
                Arr::get($data, 'description'),
                Arr::get($data, 'policies')
            )
            ->persist();

        $modelNoTrashed = Role::uuid(Arr::get($data, 'uuid'));
        $modelTrashed = Role::uuid(Arr::get($data, 'uuid'), true);
        $this->assertEquals($modelNoTrashed, $modelTrashed);
        $this->assertSame(Arr::get($data, 'id'), $modelNoTrashed->getID());
        $this->assertSame(Arr::get($data, 'uuid'), $modelNoTrashed->getUuid());
        $this->assertSame(Arr::get($data, 'name'), $modelNoTrashed->getName());
        $this->assertSame(Arr::get($data, 'description'), $modelNoTrashed->getDescription());
        $this->assertSame(Arr::get($data, 'policies'), $modelNoTrashed->getPolicies());
    }

    /**
     * Model data provider
     * @return \string[][][]
     */
    public function modelDataProvider(): array
    {
        return [
            '53cc7857-0263-4340-891c-1bdb0ce54aae'      =>  [
                'data'                                  =>  [
                    'id'                                =>  '53cc7857-0263-4340-891c-1bdb0ce54aae',
                    'uuid'                              =>  '73f66d30-ad58-4641-8b25-05b245031b50',
                    'name'                              =>  'example_role',
                    'description'                       =>  'This is an example role.',
                    'policies'                          =>  [
                        [
                            'id'                        =>  'example_policy',
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Create model instance
     * @param array $data
     * @return RoleInterface
     */
    private function model(array $data): RoleInterface
    {
        return Role::factory()->make($data);
    }

    /**
     * Create repository instance
     * @return RoleRepositoryInterface
     */
    private function repository(): RoleRepositoryInterface
    {
        return $this->app->make(RoleRepositoryInterface::class);
    }
}
