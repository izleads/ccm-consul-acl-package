<?php

namespace ConsulConfigManager\Consul\ACL\Test\Feature;

use Illuminate\Support\Arr;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Consul\ACL\Models\Token;
use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\Interfaces\TokenInterface;
use ConsulConfigManager\Consul\ACL\AggregateRoots\TokenAggregateRoot;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class TokenTest
 * @package ConsulConfigManager\Consul\ACL\Test\Feature
 */
class TokenTest extends TestCase
{
    /**
     * Common uuid
     * @var string
     */
    private static string $uuid = '0ead0ce3-1651-446e-9935-e558ad766eac';


    /**
     * @return void
     */
    public function testShouldPassIfEmptyTokensListCanBeRetrieved(): void
    {
        $response = $this->get('/consul/acl/tokens');
        $response->assertStatus(200);
        $response->assertExactJson([
            'success' => true,
            'code' => 200,
            'data' => [],
            'message' => 'Successfully fetched list of tokens',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfNonEmptyTokensListCanBeRetrieved(): void
    {
        $this->createAndGetToken();
        $response = $this->get('/consul/acl/tokens');
        $response->assertStatus(200);
        $decoded = $response->json();
        Arr::forget($decoded, 'data.0.created_at');
        Arr::forget($decoded, 'data.0.updated_at');
        ksort($decoded['data'][0]);

        $this->assertSame([
            'success' => true,
            'code' => 200,
            'data' => $this->tokensListResponse(),
            'message' => 'Successfully fetched list of tokens',
        ], $decoded);
    }

    /**
     * @return void
     */
    public function testShouldPassIfTokenCanBeRetrievedWithId(): void
    {
        $this->createAndGetToken();
        $shouldMatch = $this->tokenResponse();
        $response = $this->get('/consul/acl/tokens/' . Arr::get($shouldMatch, 'id'));
        $response->assertStatus(200);

        $decoded = $response->json();
        Arr::forget($decoded, 'data.created_at');
        Arr::forget($decoded, 'data.updated_at');
        Arr::forget($decoded, 'data.deleted_at');
        ksort($decoded['data']);

        $this->assertSame([
            'success' => true,
            'code' => 200,
            'data' => $shouldMatch,
            'message' => 'Successfully fetched token information',
        ], $decoded);
    }

    /**
     * @return void
     */
    public function testShouldPassIfTokenCanBeRetrievedWithUuid(): void
    {
        $this->createAndGetToken();
        $shouldMatch = $this->tokenResponse();
        $response = $this->get('/consul/acl/tokens/' . self::$uuid);
        $response->assertStatus(200);

        $decoded = $response->json();
        Arr::forget($decoded, 'data.created_at');
        Arr::forget($decoded, 'data.updated_at');
        Arr::forget($decoded, 'data.deleted_at');
        ksort($decoded['data']);

        $this->assertSame([
            'success' => true,
            'code' => 200,
            'data' => $shouldMatch,
            'message' => 'Successfully fetched token information',
        ], $decoded);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedForNotFound(): void
    {
        $response = $this->get('/consul/acl/tokens/' . self::$uuid);
        $response->assertStatus(404);
        $response->assertExactJson([
            'success' => false,
            'code' => 404,
            'data' => [],
            'message' => 'Unable to find token',
        ]);
    }

    /**
     * @return void
     * @throws RequestException
     */
    public function testShouldPassIfCorrectResponseReturnedFromCreate(): void
    {
        $response = $this->post('/consul/acl/tokens', [
            'description'   =>  'This is an example token.',
            'roles'         =>  [],
            'policies'      =>  [
                ['id' => '00000000-0000-0000-0000-000000000001'],
            ],
        ]);
        $response->assertStatus(201);
        $data = $response->json('data');
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('uuid', $data);
        $this->assertArrayHasKey('roles', $data);
        $this->assertArrayHasKey('policies', $data);
        $this->assertCount(1, Arr::get($data, 'policies'));
        $this->assertSame('This is an example token.', Arr::get($data, 'description'));
        $this->assertSame(false, Arr::get($data, 'local'));
        $this->service()->deleteToken(Arr::get($data, 'id'));
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedFromUpdateForNonExistentToken(): void
    {
        $response = $this->patch('/consul/acl/tokens/44764af7-e6dc-4927-bc90-5e613135eb8a', [
            'description'   =>  'This is an updated example token.',
        ]);
        $response->assertStatus(404);
    }

    /**
     * @return void
     * @throws RequestException
     */
    public function testShouldPassIfCorrectResponseReturnedFromUpdate(): void
    {
        $data = $this->post('/consul/acl/tokens', [
            'description'   =>  'This is an example token.',
            'roles'         =>  [],
            'policies'      =>  [
                ['id' => '00000000-0000-0000-0000-000000000001'],
            ],
        ])->json('data');

        $response = $this->patch('/consul/acl/tokens/' . Arr::get($data, 'id'), [
            'description'   =>  'This is an updated example token.',
            'roles'         =>  [],
            'policies'      =>  [
                ['id' => '00000000-0000-0000-0000-000000000001'],
            ],
        ]);
        $response->assertStatus(200);
        $responseData = $response->json('data');

        $this->assertSame(Arr::get($data, 'id'), Arr::get($responseData, 'id'));
        $this->assertSame('This is an updated example token.', Arr::get($responseData, 'description'));
        $this->service()->deleteToken(Arr::get($data, 'id'));
    }

    /**
     * @return void
     * @throws RequestException
     */
    public function testShouldPassIfCorrectResponseReturnedFromUpdateWithNoLocalEntry(): void
    {
        $data = $this->service()->createToken([
            'Description'   =>  'This is an example token.',
            'Roles'         =>  [],
            'Policies'      =>  [
                ['ID' => '00000000-0000-0000-0000-000000000001'],
            ],
        ]);

        $response = $this->patch('/consul/acl/tokens/' . Arr::get($data, 'accessor_id'), [
            'description'   =>  'This is an updated example token.',
            'roles'         =>  [],
            'policies'      =>  [
                ['id' => '00000000-0000-0000-0000-000000000001'],
            ],
        ]);
        $response->assertStatus(200);
        $responseData = $response->json('data');

        $this->assertSame(Arr::get($data, 'accessor_id'), Arr::get($responseData, 'id'));
        $this->assertSame('This is an updated example token.', Arr::get($responseData, 'description'));
        $this->service()->deleteToken(Arr::get($data, 'accessor_id'));
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedFromDeleteForNonExistentToken(): void
    {
        $response = $this->delete('/consul/acl/tokens/44764af7-e6dc-4927-bc90-5e613135eb8a');
        $response->assertStatus(404);
    }

    /**
     * @return void
     * @throws RequestException
     */
    public function testShouldPassIfCorrectResponseReturnedFromDelete(): void
    {
        $data = $this->post('/consul/acl/tokens', [
            'description'   =>  'This is an example token.',
            'roles'         =>  [],
            'policies'      =>  [
                ['id' => '00000000-0000-0000-0000-000000000001'],
            ],
        ])->json('data');
        $response = $this->delete('/consul/acl/tokens/' . Arr::get($data, 'id'));
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
     * @return TokenInterface
     */
    private function createAndGetToken(): TokenInterface
    {
        $configuration = $this->tokenConfiguration();
        TokenAggregateRoot::retrieve(self::$uuid)
            ->createEntity(
                Arr::get($configuration, 'id'),
                Arr::get($configuration, 'secret'),
                Arr::get($configuration, 'description'),
                Arr::get($configuration, 'roles'),
                Arr::get($configuration, 'policies'),
                Arr::get($configuration, 'local'),
            )
            ->persist();
        return Token::uuid(self::$uuid);
    }

    /**
     * Create token configuration
     * @return string[]
     */
    private function tokenConfiguration(): array
    {
        $configuration = [
            'id'            =>  '1e8f8bb7-0111-450a-3f05-56d4e3911bb9',
            'secret'        =>  'b109e841-d8c1-4548-b617-0d92ecaf0ded',
            'description'   =>  'This is an example token.',
            'roles'         =>  [],
            'policies'      =>  [],
            'local'         =>  false,
        ];
        ksort($configuration);
        return $configuration;
    }

    /**
     * Create token response
     * @return string[]
     */
    private function tokenResponse(): array
    {
        $token = $this->tokenConfiguration();
        Arr::set($token, 'uuid', self::$uuid);

        ksort($token);
        return $token;
    }

    /**
     * Create tokens response
     * @return array
     */
    private function tokensListResponse(): array
    {
        $service = $this->tokenResponse();
        Arr::forget($service, 'roles');
        Arr::forget($service, 'policies');
        Arr::forget($service, 'secret');
        ksort($service);
        return [
            $service,
        ];
    }
}
