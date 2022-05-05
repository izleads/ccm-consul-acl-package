<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit;

use ConsulConfigManager\Consul\ACL\Test\TestCase;
use ConsulConfigManager\Consul\ACL\ConsulACLDomain;

/**
 * Class ConsulACLDomainTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit
 */
class ConsulACLDomainTest extends TestCase
{
    /**
     * @return void
     */
    public function testMigrationsShouldRunByDefault(): void
    {
        $this->assertTrue(ConsulACLDomain::shouldRunMigrations());
    }

    /**
     * @return void
     */
    public function testMigrationsPublishingCanBeDisabled(): void
    {
        ConsulACLDomain::ignoreMigrations();
        $this->assertFalse(ConsulACLDomain::shouldRunMigrations());
        ConsulACLDomain::registerMigrations();
    }

    /**
     * @return void
     */
    public function testRoutesShouldNotBeRegisteredByDefault(): void
    {
        ConsulACLDomain::ignoreRoutes();
        $this->assertFalse(ConsulACLDomain::shouldRegisterRoutes());
        ConsulACLDomain::registerRoutes();
    }

    /**
     * @return void
     */
    public function testRoutesRegistrationCanBeEnabled(): void
    {
        ConsulACLDomain::registerRoutes();
        $this->assertTrue(ConsulACLDomain::shouldRegisterRoutes());
        ConsulACLDomain::ignoreRoutes();
    }
}
