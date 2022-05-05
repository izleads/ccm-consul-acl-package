<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\Events\Policy;

use Illuminate\Support\Carbon;
use ConsulConfigManager\Consul\ACL\Test\Unit\Events\AbstractEventTest;

/**
 * Class AbstractPolicyEventTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\Events\Policy
 */
abstract class AbstractPolicyEventTest extends AbstractEventTest
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
                    'name'                          =>  'example_policy',
                    'description'                   =>  'This is an example policy.',
                    'rules'                         =>  '',
                    'time'                          =>  Carbon::now(),
                    'user'                          =>  $this->userInformation(),
                ],
            ],
        ];
    }
}
