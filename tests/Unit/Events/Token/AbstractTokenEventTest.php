<?php

namespace ConsulConfigManager\Consul\ACL\Test\Unit\Events\Token;

use Illuminate\Support\Carbon;
use ConsulConfigManager\Consul\ACL\Test\Unit\Events\AbstractEventTest;

/**
 * Class AbstractTokenEventTest
 * @package ConsulConfigManager\Consul\ACL\Test\Unit\Events\Token
 */
abstract class AbstractTokenEventTest extends AbstractEventTest
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
                    'secret'                        =>  'b109e841-d8c1-4548-b617-0d92ecaf0ded',
                    'description'                   =>  'This is an example token.',
                    'policies'                      =>  [],
                    'roles'                         =>  [],
                    'local'                         =>  false,
                    'time'                          =>  Carbon::now(),
                    'user'                          =>  $this->userInformation(),
                ],
            ],
        ];
    }
}
