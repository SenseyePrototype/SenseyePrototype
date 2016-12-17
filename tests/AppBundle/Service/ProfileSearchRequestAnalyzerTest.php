<?php

namespace Tests\AppBundle\Service;

use AppBundle\Component\ProfileAvailableCriteria;
use AppBundle\Component\ProfileSearchCriteria;
use Symfony\Component\HttpFoundation\Request;

class ProfileSearchRequestAnalyzerTestCase extends TestCase
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

    private $availableMust = [
        'skills' => [
            [
                'alias' => 'php',
                'name' => 'PHP',
            ],
            [
                'alias' => 'mysql',
                'name' => 'MySQL',
            ],
            [
                'alias' => 'javascript',
                'name' => 'JavaScript',
            ],
        ],
    ];

    private $availableRange = [
        'salary' => [
            'from' => 100,
            'to' => 25000,
        ]
    ];

    public function testEmpty()
    {
        $searchCriteria = $this
            ->getService()
            ->analyze(
                new ProfileAvailableCriteria([], [], []),
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
                new ProfileAvailableCriteria($this->availableMulti, [], []),
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

    /**
     * @dataProvider salaryDataProvider
     * @param $salary
     * @param $from
     * @param $to
     */
    public function testSalary($salary, $from, $to)
    {
        $searchCriteria = $this
            ->getService()
            ->analyze(
                new ProfileAvailableCriteria([], [], $this->availableRange),
                new Request(['salary' => $salary])
            );

        $this->assertSame($from, $searchCriteria->getSalaryRange()->getFrom());
        $this->assertSame($to, $searchCriteria->getSalaryRange()->getTo());
        $this->assertSame(true, $searchCriteria->getSalaryRange()->exists());
    }

    public function salaryDataProvider()
    {
        yield ['101', 101, null];
        yield ['107-', 107, null];
        yield ['108-1', 108, null];
        yield ['1000-1000', 1000, 1000];
        yield ['1000-1500', 1000, 1500];
        yield ['1000-25000', 1000, null];
        yield ['1000-25001', 1000, null];
        yield ['-100', null, 100];
        yield ['-2000', null, 2000];
    }

    /**
     * @dataProvider salaryOutRangeDataProvider
     * @param $salary
     */
    public function testSalaryOutRange($salary)
    {
        $searchCriteria = $this
            ->getService()
            ->analyze(
                new ProfileAvailableCriteria([], [], $this->availableRange),
                new Request(['salary' => $salary])
            );

        $this->assertSame(false, $searchCriteria->getSalaryRange()->exists());
    }

    public function salaryOutRangeDataProvider()
    {
        yield [''];
        yield ['0'];
        yield ['100'];
        yield ['25001'];
        yield ['125000'];

        yield ['one'];
        yield ['one-'];
        yield ['-two'];
        yield ['one-two'];
        yield [['one-two']];
    }

    /**
     * @dataProvider skillDataProvider
     * @param array $query
     * @param $multi
     */
    public function testMust(array $query, array $multi)
    {
        $searchCriteria = $this
            ->getService()
            ->analyze(
                new ProfileAvailableCriteria([], $this->availableMust, []),
                new Request($query)
            );

        $this->assertSame($multi, $searchCriteria->getMustMap());
    }

    public function skillDataProvider()
    {
        yield [
            ['skills' => 'php,javascript,mysql'],
            $this->availableMust
        ];
    }

    private function getService()
    {
        return $this->container->get('senseye.profile.search.request.analyzer');
    }
}
