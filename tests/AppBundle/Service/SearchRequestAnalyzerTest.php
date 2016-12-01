<?php

namespace Tests\AppBundle\Service;

use AppBundle\Component\ProfileAvailableCriteria;
use AppBundle\Component\ProfileSearchCriteria;
use Symfony\Component\HttpFoundation\Request;

class SearchRequestAnalyzerTestCase extends TestCase
{
    private $availableMulti = [
        'cities' => [
            [
                'alias' => 'kiev',
                'name' => 'Київ',
            ],
            [
                'alias' => 'lviv',
                'name' => 'Львів',
            ],
        ],
    ];

    public function testEmpty()
    {
        $searchCriteria = $this
            ->getService()
            ->analyze(
                new ProfileAvailableCriteria([], []),
                new Request()
            );

        $this->assertInstanceOf(ProfileSearchCriteria::class, $searchCriteria);
    }

    /**
     * @dataProvider cityDataProvider
     * @param array $query
     * @param $multi
     */
    public function testMulti(array $query, array $multi)
    {
        $searchCriteria = $this
            ->getService()
            ->analyze(
                new ProfileAvailableCriteria($this->availableMulti, []),
                new Request($query)
            );

        $this->assertSame($multi, $searchCriteria->getMultiMap());
    }

    public function cityDataProvider()
    {
        yield [
            ['cities' => 'lviv'],
            [
                'cities' => [
                    [
                        'alias' => 'lviv',
                        'name' => 'Львів',
                    ],
                ],
            ],
        ];

        yield [
            ['cities' => 'lviv,kiev'],
            [
                'cities' => [
                    [
                        'alias' => 'kiev',
                        'name' => 'Київ',
                    ],
                    [
                        'alias' => 'lviv',
                        'name' => 'Львів',
                    ],
                ],
            ],
        ];

        yield [
            ['cities' => ',lviv,,,kiev,'],
            [
                'cities' => [
                    [
                        'alias' => 'kiev',
                        'name' => 'Київ',
                    ],
                    [
                        'alias' => 'lviv',
                        'name' => 'Львів',
                    ],
                ],
            ],
        ];

        yield [
            ['cities' => 'somelviv,somekiev'],
            [],
        ];

        yield [
            ['cities' => ['somelviv,somekiev']],
            [],
        ];
    }

    private function getService()
    {
        return $this->container->get('senseye.profile.search.request.analyzer');
    }
}
