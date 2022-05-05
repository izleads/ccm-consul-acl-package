<?php

namespace ConsulConfigManager\Consul\ACL\Test\Integration;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\Services\AbstractService;

/**
 * Class AbstractServiceTest
 * @package ConsulConfigManager\Consul\ACL\Test\Integration
 */
abstract class AbstractServiceTest extends TestCase
{
    /**
     * Class we are currently testing
     * @var AbstractService
     */
    private AbstractService $testedClass;

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->testedClass = new class () extends AbstractService {
            public function clientInstance()
            {
                return $this->client();
            }
        };
    }

    public function testShouldPassIfSpecifiedServiceIsOnline(): void
    {
        $response = $this->testedClass->serverOnline(
            config('consul.acl.connections.default.host'),
            config('consul.acl.connections.default.port'),
        );
        $this->assertTrue($response);
    }

    public function testShouldPassIfSpecifiedServerIsOffline(): void
    {
        $response = $this->testedClass->serverOnline(
            config('consul.acl.connections.default.host'),
            1234,
        );
        $this->assertFalse($response);
    }
}
