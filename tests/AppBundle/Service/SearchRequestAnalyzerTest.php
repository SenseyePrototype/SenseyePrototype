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
     * @param array $cities
     * @param $expected
     */
    public function testCity($cities, $expected)
    {
        $searchCriteria = $this
            ->getService()
            ->analyze(
                new ProfileAvailableCriteria($this->availableMulti, []),
                new Request(['cities' => $cities])
            );

        $this->assertSame($expected, $searchCriteria->getMultiMap());
    }

    public function cityDataProvider()
    {
        yield [
            'lviv',
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
            'lviv,kiev',
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
    }

    private function getService()
    {
        return $this->container->get('senseye.profile.search.request.analyzer');
    }
}
