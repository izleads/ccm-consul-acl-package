<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\Repositories;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\ACL\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleRepositoryInterface;

/**
 * Class RoleRepositoryTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\Repositories
 */
class RoleRepositoryTest extends AbstractRepositoryTest
{
    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfCanCreateNewEntry(array $data): void
    {
        $this->createEntity($data);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfCanUpdateExistingEntry(array $data): void
    {
        $this->createEntity($data);

        Arr::set($data, 'policies', [
            [
                'id'    =>  'new_example_policy',
            ],
        ]);
        $entity = $this->repository()->update(
            Arr::get($data, 'id'),
            Arr::get($data, 'name'),
            Arr::get($data, 'description'),
            Arr::get($data, 'policies'),
        );
        $this->assertSameReturned($entity, $data);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromAllRequest(array $data): void
    {
        $this->createEntity($data);
        $response = $this->repository()->all();
        $this->assertSameReturned($response->first(), $data);
    }


    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindRequest(array $data): void
    {
        $this->createEntity($data);

        $response = $this->repository()->find(Arr::get($data, 'id'));
        $this->assertSameReturned($response, $data);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindOrFailRequest(array $data): void
    {
        $this->createEntity($data);

        $response = $this->repository()->findOrFail(Arr::get($data, 'id'));
        $this->assertSameReturned($response, $data);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfExceptionIsThrownOnModelNotFoundFromFindOrFailRequest(array $data): void
    {
        $this->expectException(ModelNotFoundException::class);
        $this->repository()->findOrFail(Arr::get($data, 'id'));
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByManyRequest(array $data): void
    {
        $this->createEntity($data);

        $response = $this->repository()->findByMany(['id', 'uuid'], Arr::get($data, 'id'));
        $this->assertSameReturned($response, $data);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromFindByManyOrFailRequest(array $data): void
    {
        $this->expectException(ModelNotFoundException::class);
        $this->repository()->findByManyOrFail(['id', 'uuid'], Arr::get($data, 'id'));
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfTrueReturnedFromDeleteMethod(array $data): void
    {
        $this->createEntity($data);
        $response = $this->repository()->delete(Arr::get($data, 'id'));
        $this->assertTrue($response);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfFalseReturnedFromDeleteMethod(array $data): void
    {
        $response = $this->repository()->delete(Arr::get($data, 'id'));
        $this->assertFalse($response);
    }

    /**
     * @param array $data
     * @dataProvider entityDataProvider
     * @return void
     */
    public function testShouldPassIfTrueReturnedFromForceDeleteMethod(array $data): void
    {
        $this->createEntity($data);
        $response = $this->repository()->forceDelete(Arr::get($data, 'id'));
        $this->assertTrue($response);
    }

    /**
     * Create new repository instance
     * @return RoleRepositoryInterface
     */
    private function repository(): RoleRepositoryInterface
    {
        return $this->app->make(RoleRepositoryInterface::class);
    }

    /**
     * Create new entity
     * @param array $data
     * @return void
     */
    private function createEntity(array $data): void
    {
        $entity = $this->repository()->create(
            Arr::get($data, 'id'),
            Arr::get($data, 'name'),
            Arr::get($data, 'description'),
            Arr::get($data, 'policies'),
        );
        $this->assertSameReturned($entity, $data);
    }

    /**
     * Assert that data returned is the same as in array
     * @param Role $entity
     * @param array $data
     * @return void
     */
    private function assertSameReturned(Role $entity, array $data)
    {
        $this->assertInstanceOf(Role::class, $entity);
        $this->assertArrayHasKey('uuid', $entity);
        $this->assertSame(Arr::get($data, 'id'), $entity->getID());
        $this->assertSame(Arr::get($data, 'name'), $entity->getName());
        $this->assertSame(Arr::get($data, 'description'), $entity->getDescription());
        $this->assertSame(Arr::get($data, 'policies'), $entity->getPolicies());
    }

    /**
     * Entity data provider
     * @return \array[][]
     */
    public function entityDataProvider(): array
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
}
