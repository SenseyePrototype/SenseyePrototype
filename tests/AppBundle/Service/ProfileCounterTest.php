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
                'must' => [],
                'range' => [],
            ],
            $counterResponse->getData()
        );
    }
}
