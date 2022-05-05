<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\Events\Role;

use Illuminate\Support\Carbon;
use ConsulConfigManager\Consul\ACL\Test\Unit\Events\AbstractEventTest;

/**
 * Class AbstractRoleEventTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\Events\Role
 */
abstract class AbstractRoleEventTest extends AbstractEventTest
{
    /**
     * Event data provider
     * @return \array[][]
     */
    public function eventDataProvider(): array
    {
        return [
            '53cc7857-0263-4340-891c-1bdb0ce54aae'  =>  [
                'data'                              =>  [
                    'id'                            =>  '53cc7857-0263-4340-891c-1bdb0ce54aae',
                    'uuid'                          =>  '73f66d30-ad58-4641-8b25-05b245031b50',
                    'name'                          =>  'example_role',
                    'description'                   =>  'This is an example role.',
                    'policies'                      =>  [],
                    'time'                          =>  Carbon::now(),
                    'user'                          =>  $this->userInformation(),
                ],
            ],
        ];
    }
}
