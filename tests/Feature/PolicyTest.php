<?php

namespace ConsulConfigManager\Consul\ACL\Test\Feature;

use Illuminate\Support\Arr;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Consul\ACL\Models\Policy;
use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\Interfaces\PolicyInterface;
use ConsulConfigManager\Consul\ACL\AggregateRoots\PolicyAggregateRoot;
use ConsulConfigManager\Consul\ACL\Interfaces\AccessControlListServiceInterface;

/**
 * Class PolicyTest
 * @package ConsulConfigManager\Consul\ACL\Test\Feature
 */
class PolicyTest extends TestCase
{
    /**
     * Common uuid
     * @var string
     */
    private static string $uuid = '0ead0ce3-1651-446e-9935-e558ad766eac';

    /**
     * @return void
     */
    public function testShouldPassIfEmptyPoliciesListCanBeRetrieved(): void
    {
        $response = $this->get('/consul/acl/policies');
        $response->assertStatus(200);
        $response->assertExactJson([
            'success'       =>  true,
            'code'          =>  200,
            'data'          =>  [],
            'message'       =>  'Successfully fetched list of policies',
        ]);
    }

    /**
     * @return void
     */
    public function testShouldPassIfNonEmptyPoliciesListCanBeRetrieved(): void
    {
        $this->createAndGetPolicy();
        $response = $this->get('/consul/acl/policies');
        $response->assertStatus(200);
        $decoded = $response->json();
        Arr::forget($decoded, 'data.0.created_at');
        Arr::forget($decoded, 'data.0.updated_at');
        ksort($decoded['data'][0]);

        $this->assertSame([
            'success'       =>  true,
            'code'          =>  200,
            'data'          =>  $this->policiesListResponse(),
            'message'       =>  'Successfully fetched list of policies',
        ], $decoded);
    }

    /**
     * @return void
     */
    public function testShouldPassIfPolicyCanBeRetrievedWithId(): void
    {
        $this->createAndGetPolicy();
        $shouldMatch = $this->policyResponse();
        $response = $this->get('/consul/acl/policies/' . Arr::get($shouldMatch, 'id'));
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
            'message'       =>  'Successfully fetched policy information',
        ], $decoded);
    }

    /**
     * @return void
     */
    public function testShouldPassIfPolicyCanBeRetrievedWithUuid(): void
    {
        $this->createAndGetPolicy();
        $shouldMatch = $this->policyResponse();
        $response = $this->get('/consul/acl/policies/' . self::$uuid);
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
            'message'       =>  'Successfully fetched policy information',
        ], $decoded);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedForNotFound(): void
    {
        $response = $this->get('/consul/acl/policies/' . self::$uuid);
        $response->assertStatus(404);
        $response->assertExactJson([
            'success'       =>  false,
            'code'          =>  404,
            'data'          =>  [],
            'message'       =>  'Unable to find policy',
        ]);
    }

    /**
     * @return void
     * @throws RequestException
     */
    public function testShouldPassIfCorrectResponseReturnedFromCreate(): void
    {
        $response = $this->post('/consul/acl/policies', [
            'name'          =>  'example_policy',
            'description'   =>  'This is an example policy.',
            'rules'         =>  'agent_prefix "" { policy = "read" }',
        ]);
        $response->assertStatus(201);
        $data = $response->json('data');
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('uuid', $data);
        $this->assertArrayHasKey('rules', $data);
        $this->assertSame('example_policy', Arr::get($data, 'name'));
        $this->assertSame('This is an example policy.', Arr::get($data, 'description'));
        $this->service()->deletePolicy(Arr::get($data, 'id'));
    }

    /**
     * @return void
     * @throws RequestException
     */
    public function testShouldPassIfCorrectResponseReturnedFromCreateWhenPolicyAlreadyExists(): void
    {
        $data = $this->post('/consul/acl/policies', [
            'name'          =>  'example_policy',
            'description'   =>  'This is an example policy.',
            'rules'         =>  'agent_prefix "" { policy = "read" }',
        ])->json('data');
        $response = $this->post('/consul/acl/policies', [
            'name'          =>  'example_policy',
            'description'   =>  'This is an example policy.',
            'rules'         =>  'agent_prefix "" { policy = "read" }',
        ]);
        $response->assertStatus(409);
        $this->service()->deletePolicy(Arr::get($data, 'id'));
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedFromUpdateForNonExistentPolicy(): void
    {
        $response = $this->patch('/consul/acl/policies/44764af7-e6dc-4927-bc90-5e613135eb8a', [
            'name'          =>  'example_policy',
            'description'   =>  'This is an example policy.',
            'rules'         =>  'agent_prefix "" { policy = "read" }',
        ]);
        $response->assertStatus(404);
    }

    /**
     * @return void
     * @throws RequestException
     */
    public function testShouldPassIfCorrectResponseReturnedFromUpdate(): void
    {
        $data = $this->post('/consul/acl/policies', [
            'name'          =>  'example_policy',
            'description'   =>  'This is an example policy.',
            'rules'         =>  'agent_prefix "" { policy = "read" }',
        ])->json('data');

        $response = $this->patch('/consul/acl/policies/' . Arr::get($data, 'id'), [
            'name'          =>  'example_policy',
            'description'   =>  'This is an example policy.',
            'rules'         =>  'agent_prefix "" { policy = "write" }',
        ]);
        $response->assertStatus(200);
        $responseData = $response->json('data');

        $this->assertSame(Arr::get($data, 'id'), Arr::get($responseData, 'id'));
        $this->assertSame(Arr::get($data, 'name'), Arr::get($responseData, 'name'));
        $this->assertSame('agent_prefix "" { policy = "write" }', Arr::get($responseData, 'rules'));
        $this->service()->deletePolicy(Arr::get($data, 'id'));
    }

    /**
     * @return void
     * @throws RequestException
     */
    public function testShouldPassIfCorrectResponseReturnedFromUpdateWithNoLocalEntry(): void
    {
        $data = $this->service()->createPolicy([
            'Name'          =>  'example_policy',
            'Description'   =>  'This is an example policy.',
            'Rules'         =>  'agent_prefix "" { policy = "read" }',
        ]);

        $response = $this->patch('/consul/acl/policies/' . Arr::get($data, 'id'), [
            'name'          =>  'example_policy',
            'description'   =>  'This is an example policy.',
            'rules'         =>  'agent_prefix "" { policy = "write" }',
        ]);
        $response->assertStatus(200);
        $responseData = $response->json('data');

        $this->assertSame(Arr::get($data, 'id'), Arr::get($responseData, 'id'));
        $this->assertSame(Arr::get($data, 'name'), Arr::get($responseData, 'name'));
        $this->assertSame('agent_prefix "" { policy = "write" }', Arr::get($responseData, 'rules'));
        $this->service()->deletePolicy(Arr::get($data, 'id'));
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedFromDeleteForNonExistentPolicy(): void
    {
        $response = $this->delete('/consul/acl/policies/44764af7-e6dc-4927-bc90-5e613135eb8a');
        $response->assertStatus(404);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedFromDelete(): void
    {
        $data = $this->post('/consul/acl/policies', [
            'name'          =>  'example_policy',
            'description'   =>  'This is an example policy.',
            'rules'         =>  'agent_prefix "" { policy = "read" }',
        ])->json('data');

        $response = $this->delete('/consul/acl/policies/' . Arr::get($data, 'id'));
        $response->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testShouldPassIfCorrectResponseReturnedFromAutocomplete(): void
    {
        $creationResponse = $this->post('/consul/acl/policies', [
            'name'          =>  'example_policy',
            'description'   =>  'This is an example policy.',
            'rules'         =>  'agent_prefix "" { policy = "read" }',
        ]);
        $creationResponse->assertStatus(201);
        $creationResponseData = $creationResponse->json('data');

        $response = $this->get('/consul/acl/policies/autocomplete');
        $response->assertStatus(200);
        $data = $response->json('data');

        $this->assertCount(1, $data);
        $this->assertArrayHasKey('name', Arr::first($data));
        $this->assertArrayHasKey('description', Arr::first($data));
        $this->assertSame('example_policy', Arr::get(Arr::first($data), 'name'));
        $this->assertSame('This is an example policy.', Arr::get(Arr::first($data), 'description'));

        $deletionResponse = $this->delete('/consul/acl/policies/' . Arr::get($creationResponseData, 'id'));
        $deletionResponse->assertStatus(200);
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
     * @return PolicyInterface
     */
    private function createAndGetPolicy(): PolicyInterface
    {
        $configuration = $this->policyConfiguration();
        PolicyAggregateRoot::retrieve(self::$uuid)
            ->createEntity(
                Arr::get($configuration, 'id'),
                Arr::get($configuration, 'name'),
                Arr::get($configuration, 'description'),
                Arr::get($configuration, 'rules'),
            )
            ->persist();
        return Policy::uuid(self::$uuid);
    }

    /**
     * Create policy configuration
     * @return string[]
     */
    private function policyConfiguration(): array
    {
        $configuration = [
            'id'            =>  '1e8f8bb7-0111-450a-3f05-56d4e3911bb9',
            'name'          =>  'example_policy',
            'description'   =>  'This is an example policy.',
            'rules'         =>  '',
        ];
        ksort($configuration);
        return $configuration;
    }

    /**
     * Create policy response
     * @return string[]
     */
    private function policyResponse(): array
    {
        $policy = $this->policyConfiguration();
        Arr::set($policy, 'uuid', self::$uuid);

        ksort($policy);
        return $policy;
    }

    /**
     * Create policies response
     * @return array
     */
    private function policiesListResponse(): array
    {
        $service = $this->policyResponse();
        Arr::forget($service, 'rules');
        ksort($service);
        return [
            $service,
        ];
    }
}
