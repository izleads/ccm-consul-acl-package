<?php

namespace ConsulConfigManager\Consul\ACL\Test\Integration;

use LdapRecord\Support\Arr;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Consul\ACL\Services\AccessControlListService;

/**
 * Class PoliciesTest
 * @package ConsulConfigManager\Consul\ACL\Test\Integration
 */
class PoliciesTest extends AbstractServiceTest
{
    /**
     * @throws RequestException
     * @return void
     */
    public function testShouldPassIfPolicyCanBeCreated(): void
    {
        $parameters = [
            'Name'          =>  'example-policy',
            'Description'   =>  'Example Policy',
            'Roles'         =>  [],
        ];
        $response = $this->service()->createPolicy($parameters);
        $this->assertArrayHasKey('id', $response);
        $this->assertEquals(Arr::get($parameters, 'Name'), Arr::get($response, 'name'));
        $this->assertEquals(Arr::get($parameters, 'Description'), Arr::get($response, 'description'));
    }

    /**
     * @throws RequestException
     * @return void
     */
    public function testShouldPassIfPolicyCanBeReadByName(): void
    {
        $response = $this->service()->readPolicyByName('example-policy');
        $this->assertIsArray($response);
    }

    /**
     * @throws RequestException
     * @return void
     */
    public function testShouldPassIfPolicyCanBeReadById(): void
    {
        $byNameResponse = $this->service()->readPolicyByName('example-policy');
        $byIdResponse = $this->service()->readPolicy(Arr::get($byNameResponse, 'id'));
        $this->assertEquals($byNameResponse, $byIdResponse);
    }

    /**
     * @throws RequestException
     * @return void
     */
    public function testShouldPassIfPolicyCanBeUpdated(): void
    {
        $byNameResponse = $this->service()->readPolicyByName('example-policy');
        $response = $this->service()->updatePolicy(Arr::get($byNameResponse, 'id'), [
            'Name'              =>  'example-policy',
            'Description'       =>  'New Description',
        ]);
        $this->assertEquals('New Description', Arr::get($response, 'description'));
    }

    /**
     * @throws RequestException
     * @return void
     */
    public function testShouldPassIfPoliciesCanBeListed(): void
    {
        $response = $this->service()->listPolicies();
        $this->assertCount(2, $response);
    }

    /**
     * @throws RequestException
     * @return void
     */
    public function testShouldPassIfPolicyCanBeDeleted(): void
    {
        $byNameResponse = $this->service()->readPolicyByName('example-policy');
        $response = $this->service()->deletePolicy(Arr::get($byNameResponse, 'id'));
        $this->assertTrue($response);
    }

    /**
     * Create new service instance
     * @return AccessControlListService
     */
    private function service(): AccessControlListService
    {
        return new AccessControlListService();
    }
}
