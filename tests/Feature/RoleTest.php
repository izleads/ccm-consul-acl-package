<?php

namespace ConsulConfigManager\Consul\ACL\Test\Feature;

use Illuminate\Support\Arr;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Consul\ACL\Models\Role;
use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\Interfaces\RoleInterface;
use ConsulConfigManager\Consul\ACL\AggregateRoots\RoleAggregateRoot;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class RoleTest
 * @package ConsulConfigManager\Consul\ACL\Test\Feature
 */
class RoleTest extends TestCase
{
    /**
     * Common uuid
     * @var string
     */
    private static string $uuid = '0ead0ce3-1651-446e-9935-e558ad766eac';

    /**
     * @return void
     */
    public function testShouldPassIfEmptyRolesListCanBeRetrieved(): void
    {
        $response = $this->get('/consul/acl/roles');
        $response->assertStatus(200);
        $response->assertExactJson([
            'success'       =>  true,
            'code'          =>  200,
            'data'          =>  [],
            'message'       =>  'Successfully fetched list of roles',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfNonEmptyRolesListCanBeRetrieved(): void
    {
        $this->createAndGetRole();
        $response = $this->get('/consul/acl/roles');
        $response->assertStatus(200);
        $decoded = $response->json();
        Arr::forget($decoded, 'data.0.created_at');
        Arr::forget($decoded, 'data.0.updated_at');
        ksort($decoded['data'][0]);

        $this->assertSame([
            'success'       =>  true,
            'code'          =>  200,
            'data'          =>  $this->rolesListResponse(),
            'message'       =>  'Successfully fetched list of roles',
        ], $decoded);
    }

    /**
     * @return void
     */
    public function testShouldPassIfRoleCanBeRetrievedWithId(): void
    {
        $this->createAndGetRole();
        $shouldMatch = $this->roleResponse();
        $response = $this->get('/consul/acl/roles/' . Arr::get($shouldMatch, 'id'));
        $response->assertStatus(200);

        $decoded = $response->json();
        Arr::forget($decoded, 'data.created_at');
        Arr::forget($decoded, 'data.updated_at');
        Arr::forget($decoded, 'data.deleted_at');
        ksort($decoded['data']);

        $this->assertSame([
            'success'       =>  true,
            'code'          =>  200,
            'data'          =>  $shouldMatch,
            'message'       =>  'Successfully fetched role information',
        ], $decoded);
    }

    /**
     * @return void
     */
    public function testShouldPassIfRoleCanBeRetrievedWithUuid(): void
    {
        $this->createAndGetRole();
        $shouldMatch = $this->roleResponse();
        $response = $this->get('/consul/acl/roles/' . self::$uuid);
        $response->assertStatus(200);

        $decoded = $response->json();
        Arr::forget($decoded, 'data.created_at');
        Arr::forget($decoded, 'data.updated_at');
        Arr::forget($decoded, 'data.deleted_at');
        ksort($decoded['data']);

        $this->assertSame([
            'success'       =>  true,
            'code'          =>  200,
            'data'          =>  $shouldMatch,
            'message'       =>  'Successfully fetched role information',
        ], $decoded);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedForNotFound(): void
    {
        $response = $this->get('/consul/acl/roles/' . self::$uuid);
        $response->assertStatus(404);
        $response->assertExactJson([
            'success'       =>  false,
            'code'          =>  404,
            'data'          =>  [],
            'message'       =>  'Unable to find role',
        ]);
    }


    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedFromDeleteForNonExistentRole(): void
    {
        $response = $this->delete('/consul/acl/roles/44764af7-e6dc-4927-bc90-5e613135eb8a');
        $response->assertStatus(404);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedFromDelete(): void
    {
        $data = $this->post('/consul/acl/roles', [
            'name'          =>  'example_role',
            'description'   =>  'This is an example role.',
            'policies'      =>  [
                [
                    'id'    =>  '00000000-0000-0000-0000-000000000001',
                    'name'  =>  'global-management',
                ],
            ],
        ])->json('data');

        $response = $this->delete('/consul/acl/roles/' . Arr::get($data, 'id'));
        $response->assertStatus(200);
    }

    /**
     * @return void
     * @throws RequestException
     */
    public function testShouldPassIfCorrectResponseReturnedFromCreate(): void
    {
        $response = $this->post('/consul/acl/roles', [
            'name'          =>  'example_role',
            'description'   =>  'This is an example role.',
            'policies'      =>  [
                [
                    'id'    =>  '00000000-0000-0000-0000-000000000001',
                    'name'  =>  'global-management',
                ],
            ],
        ]);
        $response->assertStatus(201);
        $data = $response->json('data');

        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('uuid', $data);
        $this->assertArrayHasKey('policies', $data);
        $this->assertSame('example_role', Arr::get($data, 'name'));
        $this->assertSame('This is an example role.', Arr::get($data, 'description'));
        $this->assertCount(1, Arr::get($data, 'policies'));

        $response = $this->delete('/consul/acl/roles/' . Arr::get($data, 'id'));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedFromCreateWhenPolicyAlreadyExists(): void
    {
        $data = $this->post('/consul/acl/roles', [
            'name'          =>  'example_role',
            'description'   =>  'This is an example role.',
            'policies'      =>  [
                [
                    'id'    =>  '00000000-0000-0000-0000-000000000001',
                    'name'  =>  'global-management',
                ],
            ],
        ])->json('data');
        $response = $this->post('/consul/acl/roles', [
            'name'          =>  'example_role',
            'description'   =>  'This is an example role.',
            'policies'      =>  [
                [
                    'id'    =>  '00000000-0000-0000-0000-000000000001',
                    'name'  =>  'global-management',
                ],
            ],
        ]);
        $response->assertStatus(409);

        $response = $this->delete('/consul/acl/roles/' . Arr::get($data, 'id'));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedFromUpdateForNonExistentPolicy(): void
    {
        $response = $this->patch('/consul/acl/roles/44764af7-e6dc-4927-bc90-5e613135eb8a', [
            'name'          =>  'example_role',
            'description'   =>  'This is an example role.',
            'policies'      =>  [
                [
                    'id'    =>  '00000000-0000-0000-0000-000000000001',
                    'name'  =>  'global-management',
                ],
            ],
        ]);
        $response->assertStatus(404);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedFromUpdate(): void
    {
        $data = $this->post('/consul/acl/roles', [
            'name'          =>  'example_role',
            'description'   =>  'This is an example role.',
            'policies'      =>  [
                [
                    'id'    =>  '00000000-0000-0000-0000-000000000001',
                    'name'  =>  'global-management',
                ],
            ],
        ])->json('data');

        $response = $this->patch('/consul/acl/roles/' . Arr::get($data, 'id'), [
            'name'          =>  'example_role',
            'description'   =>  'Hi',
            'policies'      =>  [
                [
                    'id'    =>  '00000000-0000-0000-0000-000000000001',
                    'name'  =>  'global-management',
                ],
            ],
        ]);
        $response->assertStatus(200);
        $responseData = $response->json('data');

        $this->assertSame(Arr::get($data, 'id'), Arr::get($responseData, 'id'));
        $this->assertSame(Arr::get($data, 'name'), Arr::get($responseData, 'name'));
        $this->assertSame('Hi', Arr::get($responseData, 'description'));

        $response = $this->delete('/consul/acl/roles/' . Arr::get($data, 'id'));
        $response->assertStatus(200);
    }

    /**
     * @return void
     * @throws RequestException
     */
    public function testShouldPassIfCorrectResponseReturnedFromUpdateWithNoLocalEntry(): void
    {
        $data = $this->service()->createRole([
            'Name'          =>  'example_role',
            'Description'   =>  'This is an example role.',
            'Policies'      =>  [
                [
                    'ID'    =>  '00000000-0000-0000-0000-000000000001',
                    'Name'  =>  'global-management',
                ],
            ],
        ]);

        $response = $this->patch('/consul/acl/roles/' . Arr::get($data, 'id'), [
            'name'          =>  'example_role',
            'description'   =>  'Hi',
            'policies'      =>  [
                [
                    'id'    =>  '00000000-0000-0000-0000-000000000001',
                    'name'  =>  'global-management',
                ],
            ],
        ]);
        $response->assertStatus(200);
        $responseData = $response->json('data');

        $this->assertSame(Arr::get($data, 'id'), Arr::get($responseData, 'id'));
        $this->assertSame(Arr::get($data, 'name'), Arr::get($responseData, 'name'));
        $this->assertSame('Hi', Arr::get($responseData, 'description'));

        $response = $this->delete('/consul/acl/roles/' . Arr::get($data, 'id'));
        $response->assertStatus(200);
    }

    /**
     * Create new service instance
     * @return AccessControlListServiceInterface
     */
    private function service(): AccessControlListServiceInterface
    {
        return $this->app->make(AccessControlListServiceInterface::class);
    }

    /**
     * Create new service and return its model
     * @return RoleInterface
     */
    private function createAndGetRole(): RoleInterface
    {
        $configuration = $this->roleConfiguration();
        RoleAggregateRoot::retrieve(self::$uuid)
            ->createEntity(
                Arr::get($configuration, 'id'),
                Arr::get($configuration, 'name'),
                Arr::get($configuration, 'description'),
                Arr::get($configuration, 'policies'),
            )
            ->persist();
        return Role::uuid(self::$uuid);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedFromAutocomplete(): void
    {
        $creationResponse = $this->post('/consul/acl/roles', [
            'name'          =>  'example_role',
            'description'   =>  'This is an example role.',
            'policies'      =>  [
                [
                    'id'    =>  '00000000-0000-0000-0000-000000000001',
                    'name'  =>  'global-management',
                ],
            ],
        ]);
        $creationResponse->assertStatus(201);
        $creationResponseData = $creationResponse->json('data');

        $response = $this->get('/consul/acl/roles/autocomplete');
        $response->assertStatus(200);
        $data = $response->json('data');

        $this->assertCount(1, $data);
        $this->assertArrayHasKey('name', Arr::first($data));
        $this->assertArrayHasKey('description', Arr::first($data));
        $this->assertSame('example_role', Arr::get(Arr::first($data), 'name'));
        $this->assertSame('This is an example role.', Arr::get(Arr::first($data), 'description'));

        $deletionResponse = $this->delete('/consul/acl/roles/' . Arr::get($creationResponseData, 'id'));
        $deletionResponse->assertStatus(200);
    }

    /**
     * Create role configuration
     * @return string[]
     */
    private function roleConfiguration(): array
    {
        $configuration = [
            'id'            =>  '1e8f8bb7-0111-450a-3f05-56d4e3911bb9',
            'name'          =>  'example_role',
            'description'   =>  'This is an example role.',
            'policies'      =>  [],
        ];
        ksort($configuration);
        return $configuration;
    }

    /**
     * Create role response
     * @return string[]
     */
    private function roleResponse(): array
    {
        $role = $this->roleConfiguration();
        Arr::set($role, 'uuid', self::$uuid);

        ksort($role);
        return $role;
    }

    /**
     * Create roles response
     * @return array
     */
    private function rolesListResponse(): array
    {
        $service = $this->roleResponse();
        Arr::forget($service, 'policies');
        ksort($service);
        return [
            $service,
        ];
    }
}
