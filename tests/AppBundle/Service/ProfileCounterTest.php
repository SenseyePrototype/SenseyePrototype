<?php

namespace Tests\AppBundle\Service;

use AppBundle\Component\ProfileSearchCriteria;
use AppBundle\Component\Range;

class ProfileCounterTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @param ProfileSearchCriteria $searchCriteria
     * @param array $expected
     */
    public function test(ProfileSearchCriteria $searchCriteria, array $expected)
    {
        $counterService = $this->container->get('senseye.profile.counter');
        $available = $this->container->get('senseye.profile.available.criteria.repository')->get();

        $counterResponse = $counterService->getCounter($available, $searchCriteria);

        $this->assertSame(
            $expected,
            $counterResponse->getData()
        );
    }

    public function dataProvider()
    {
        $emptySearchCriteria = new ProfileSearchCriteria(null, [], [], new Range(), new Range());

        yield [
            $emptySearchCriteria,
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
        ];

        $searchCriteria = new ProfileSearchCriteria('architect', [], [], new Range(), new Range());

        yield [
            $searchCriteria,
            [
                'count' => 1,
                'multi' => [
                    'cities' => [
                        'kiev' => 1,
                    ],
                ],
                'must' => [
                    'skills' => [
                        'elasticsearch' => 1,
                        'git' => 1,
                        'javascript' => 1,
                        'mysql' => 1,
                        'php' => 1,
                        'phpunit' => 1,
                        'redis' => 1,
                        'symfony' => 1,
                    ],
                ],
                'range' => [],
            ],
        ];
    }
}
