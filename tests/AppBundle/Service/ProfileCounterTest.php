<?php

namespace Tests\AppBundle\Service;

use Symfony\Component\HttpFoundation\Request;

class ProfileCounterTest extends TestCase
{
    public function test()
    {
        $counterService = $this->container->get('senseye.profile.counter');

        $counterResponse = $counterService->getCounter(new Request());

        $this->assertSame(
            [
                'count' => 8,
                'multi' => [
                    'cities' => [
                        'kiev' => 8,
                        'lviv' => 2,
                        'odessa' => 1,
                    ],
                ],
                'must' => [
                    'skills' => [
                        'git' => 8,
                        'java' => 2,
                        'javascript' => 2,
                        'cpp' => 1,
                        'css' => 1,
                        'elasticsearch' => 1,
                        'golang' => 1,
                        'html' => 1,
                        'less' => 1,
                        'mysql' => 1,
                    ],
                ],
                'range' => [],
            ],
            $counterResponse->getData()
        );
    }
}
