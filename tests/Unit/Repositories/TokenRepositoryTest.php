<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\Repositories;

use Illuminate\Support\Arr;
use ConsulConfigManager\Consul\ACL\Models\Token;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ConsulConfigManager\Consul\ACL\Interfaces\TokenRepositoryInterface;

/**
 * Class TokenRepositoryTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\Repositories
 */
class TokenRepositoryTest extends AbstractRepositoryTest
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
        Arr::set($data, 'roles', [
            [
                'id'    =>  'new_example_role',
            ],
        ]);
        $entity = $this->repository()->update(
            Arr::get($data, 'id'),
            Arr::get($data, 'secret'),
            Arr::get($data, 'description'),
            Arr::get($data, 'roles'),
            Arr::get($data, 'policies'),
            Arr::get($data, 'local'),
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
     * @return TokenRepositoryInterface
     */
    private function repository(): TokenRepositoryInterface
    {
        return $this->app->make(TokenRepositoryInterface::class);
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
            Arr::get($data, 'secret'),
            Arr::get($data, 'description'),
            Arr::get($data, 'roles'),
            Arr::get($data, 'policies'),
            Arr::get($data, 'local'),
        );
        $this->assertSameReturned($entity, $data);
    }

    /**
     * Assert that data returned is the same as in array
     * @param Token $entity
     * @param array $data
     * @return void
     */
    private function assertSameReturned(Token $entity, array $data)
    {
        $this->assertInstanceOf(Token::class, $entity);
        $this->assertArrayHasKey('uuid', $entity);
        $this->assertSame(Arr::get($data, 'id'), $entity->getID());
        $this->assertSame(Arr::get($data, 'secret'), $entity->getSecret());
        $this->assertSame(Arr::get($data, 'description'), $entity->getDescription());
        $this->assertSame(Arr::get($data, 'policies'), $entity->getPolicies());
        $this->assertSame(Arr::get($data, 'roles'), $entity->getRoles());
        $this->assertSame(Arr::get($data, 'local'), $entity->isLocal());
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
                    'secret'                            =>  'b109e841-d8c1-4548-b617-0d92ecaf0ded',
                    'description'                       =>  'This is an example token.',
                    'policies'                          =>  [
                        [
                            'id'                        =>  'example_policy',
                        ],
                    ],
                    'roles'                             =>  [
                        [
                            'id'                        =>  'example_role',
                        ],
                    ],
                    'local'                             =>  false,
                ],
            ],
        ];
    }
}
