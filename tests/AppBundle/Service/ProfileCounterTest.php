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
        $searchCriteria = new ProfileSearchCriteria(null, [], [], new Range(), new Range());

        yield [
            $searchCriteria,
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
                        'php' => 1,
                        'phpunit' => 1,
                        'redis' => 1,
                        'sass' => 1,
                        'swift' => 1,
                        'symfony' => 1,
                    ],
                ],
                'range' => [
                    'salary' => [
                        'from' => 1500,
                        'to' => 5000,
                    ],
                    'experience' => [
                        'from' => 2,
                        'to' => 17,
                    ],
                ],
            ],
        ];

        $searchCriteria = new ProfileSearchCriteria(
            'develop',
            [
                'cities' => [
                    [
                        'alias' => 'kiev',
                    ],
                ],
            ],
            [
                'skills' => [
                    [
                        'alias' => 'git',
                    ],
                ],
            ],
            new Range(),
            new Range()
        );

        yield [
            $searchCriteria,
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
                        'php' => 1,
                        'phpunit' => 1,
                        'redis' => 1,
                        'sass' => 1,
                        'swift' => 1,
                        'symfony' => 1,
                    ],
                ],
                'range' => [
                    'salary' => [
                        'from' => 1500,
                        'to' => 5000,
                    ],
                    'experience' => [
                        'from' => 2,
                        'to' => 17,
                    ],
                ],
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
                'range' => [
                    'salary' => [
                        'from' => 5000,
                        'to' => 5000,
                    ],
                    'experience' => [
                        'from' => 5,
                        'to' => 5,
                    ],
                ],
            ],
        ];

        $searchCriteria = new ProfileSearchCriteria(
            'develop',
            [
                'cities' => [
                    [
                        'alias' => 'kiev',
                    ],
                ],
            ],
            [
                'skills' => [
                    [
                        'alias' => 'git',
                    ],
                ],
            ],
            new Range(1000, 3000),
            new Range(2, 15)
        );

        yield [
            $searchCriteria,
            [
                'count' => 6,
                'multi' => [
                    'cities' => [
                        'kiev' => 6,
                        'lviv' => 2,
                    ],
                ],
                'must' => [
                    'skills' => [
                        'git' => 6,
                        'java' => 2,
                        'css' => 1,
                        'golang' => 1,
                        'html' => 1,
                        'javascript' => 1,
                        'less' => 1,
                        'sass' => 1,
                        'swift' => 1,
                    ],
                ],
                'range' => [
                    'salary' => [
                        'from' => 1500,
                        'to' => 5000,
                    ],
                    'experience' => [
                        'from' => 2,
                        'to' => 7,
                    ],
                ],
            ],
        ];

        $searchCriteria = new ProfileSearchCriteria(
            null,
            [],
            [
                'skills' => [
                    [
                        'alias' => 'java',
                    ],
                ],
            ],
            new Range(),
            new Range()
        );

        yield [
            $searchCriteria,
            [
                'count' => 2,
                'multi' => [
                    'cities' => [
                        'kiev' => 2,
                        'lviv' => 1,

                    ],
                ],
                'must' => [
                    'skills' => [
                        'git' => 2,
                        'java' => 2,

                    ],
                ],
                'range' => [
                    'salary' => [
                        'from' => 1500,
                        'to' => 2000,
                    ],
                    'experience' => [
                        'from' => 2,
                        'to' => 3,
                    ],
                ],
            ],
        ];
    }
}
