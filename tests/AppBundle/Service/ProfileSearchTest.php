<?php

namespace Tests\AppBundle\Service;

use AppBundle\Component\ProfileSearchCriteria;
use AppBundle\Component\Range;
use Elastica\Document;
use Elastica\Index;

class ProfileSearchTestCase extends TestCase
{
    public function test()
    {
        $client = $this->container->get('senseye.elasticsearch.client');

        $index = $client->getIndex('developer');
        $type = $index->getType('profile');

        $this->clearIndex($index);

        $emptySearchCriteria = new ProfileSearchCriteria(null, [], [], new Range());
        $searcher = $this->container->get('senseye.profile.searcher');

        $architect = [
            'hash_code' => 1,
            'title' => 'PHP Architect',
            'cities' => [
                [
                    'alias' => 'kiev',
                    'name' => 'Київ',
                ]
            ],
            'description' => 'Develop awesome project',
            'salary' => 5000,
            'experience' => 5,
            'profiles' => [
                [
                    'alias' => 'github',
                    'name' => 'GitHub',
                    'link' => 'https://github.com/php-ukrainian-architect',
                    'verified' => true,
                ]
            ],
            'link' => 'http://senseye.project/developer/1',
            'created' => date('Y-m-d H:i:s'),
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
                [
                    'alias' => 'elasticsearch',
                    'name' => 'Elasticsearch',
                ],
                [
                    'alias' => 'redis',
                    'name' => 'Redis',
                ],
                [
                    'alias' => 'phpunit',
                    'name' => 'PHPUnit',
                ],
                [
                    'alias' => 'symfony',
                    'name' => 'Symfony',
                ],
                [
                    'alias' => 'git',
                    'name' => 'Git',
                ],
            ],
        ];

        $designer = [
            'hash_code' => 2,
            'title' => 'Designer',
            'cities' => [
                [
                    'alias' => 'kiev',
                    'name' => 'Київ',
                ]
            ],
            'description' => 'Develop awesome project',
            'salary' => 3000,
            'experience' => 7,
            'profiles' => [
                [
                    'alias' => 'github',
                    'name' => 'GitHub',
                    'link' => 'https://github.com/php-ukrainian-designer',
                    'verified' => true,
                ]
            ],
            'link' => 'http://senseye.project/developer/2',
            'created' => date('Y-m-d H:i:s'),
            'skills' => [
                [
                    'alias' => 'html',
                    'name' => 'HTML',
                ],
                [
                    'alias' => 'css',
                    'name' => 'CSS',
                ],
                [
                    'alias' => 'sass',
                    'name' => 'SASS',
                ],
                [
                    'alias' => 'less',
                    'name' => 'LESS',
                ],
                [
                    'alias' => 'git',
                    'name' => 'Git',
                ],
            ],
        ];

        $profiles = array_merge(
            [
                $architect,
                $designer,
            ],
            $this->getProfiles()
        );

        foreach ($profiles as $profile) {
            $type->addDocument(new Document($profile['hash_code'], $profile));
        }

        $index->refresh();

        $this->assertSameProfiles($profiles, $searcher->search($emptySearchCriteria));

        foreach ($this->getBothCriteria() as $criteria) {
            $this->assertSameProfiles([$architect, $designer], $searcher->search($criteria));
        }

        foreach ($this->getArchitectCriteria() as $criteria) {
            $this->assertSame([$architect], $searcher->search($criteria));
        }
    }

    private function clearIndex(Index $index)
    {
        try {
            $index->delete();
        } catch (\Exception $e) {}
    }

    private function getArchitectCriteria()
    {
        yield new ProfileSearchCriteria(null, [], [], new Range(5000, 5000));

        yield new ProfileSearchCriteria(
            null,
            [],
            [
                'skills' => [
                    [
                        'alias' => 'php',
                    ],
                ],
            ],
            new Range()
        );

        yield new ProfileSearchCriteria(
            null,
            [],
            [
                'skills' => [
                    [
                        'alias' => 'php'
                    ],
                    [
                        'alias' => 'javascript'
                    ],
                    [
                        'alias' => 'git'
                    ],
                ],
            ],
            new Range()
        );

        yield new ProfileSearchCriteria(
            null,
            [
                'profiles' => [
                    [
                        'alias' => 'github',
                    ]
                ],
            ],
            [
                'skills' => [
                    [
                        'alias' => 'php'
                    ],
                    [
                        'alias' => 'javascript'
                    ],
                    [
                        'alias' => 'git'
                    ],
                ],
            ],
            new Range(5000, 5000)
        );

        yield new ProfileSearchCriteria('architect', [], [], new Range());
    }

    private function getBothCriteria()
    {
        yield new ProfileSearchCriteria(
            null,
            [
                'profiles' => [
                    [
                        'alias' => 'github',
                    ]
                ],
            ],
            [
                'skills' => [
                    [
                        'alias' => 'git'
                    ],
                ],
            ],
            new Range(1000, 5000)
        );
    }

    private function getProfiles()
    {
        $frontend = [
            'hash_code' => 3,
            'title' => 'JavaScript Developer',
            'cities' => [
                [
                    'alias' => 'kiev',
                    'name' => 'Київ',
                ]
            ],
            'description' => 'Develop awesome project',
            'salary' => 2500,
            'experience' => 3,
            'profiles' => [],
            'link' => 'http://senseye.project/developer/3',
            'created' => date('Y-m-d H:i:s'),
            'skills' => [
                [
                    'alias' => 'javascript',
                    'name' => 'JavaScript',
                ],
                [
                    'alias' => 'git',
                    'name' => 'Git',
                ],
            ],
        ];

        $android = [
            'hash_code' => 4,
            'title' => 'Java Developer',
            'cities' => [
                [
                    'alias' => 'kiev',
                    'name' => 'Київ',
                ]
            ],
            'description' => 'Develop android application',
            'salary' => 1500,
            'experience' => 2,
            'profiles' => [],
            'link' => 'http://senseye.project/developer/4',
            'created' => date('Y-m-d H:i:s'),
            'skills' => [
                [
                    'alias' => 'Java',
                    'name' => 'Java',
                ],
                [
                    'alias' => 'git',
                    'name' => 'Git',
                ],
            ],
        ];

        $cpp = [
            'hash_code' => 5,
            'title' => 'Senior C++ Developer',
            'cities' => [
                [
                    'alias' => 'kiev',
                    'name' => 'Київ',
                ]
            ],
            'description' => 'Develop NoSQL database',
            'salary' => 3500,
            'experience' => 7,
            'profiles' => [],
            'link' => 'http://senseye.project/developer/5',
            'created' => date('Y-m-d H:i:s'),
            'skills' => [
                [
                    'alias' => 'cpp',
                    'name' => 'C++',
                ],
                [
                    'alias' => 'git',
                    'name' => 'Git',
                ],
            ],
        ];

        return [
            $frontend,
            $android,
            $cpp,
        ];
    }

    private function assertSameProfiles(array $expected, array $actual)
    {
        $expected = array_column($expected, null, 'hash_code');
        $actual = array_column($actual, null, 'hash_code');

        ksort($expected);
        ksort($actual);

        $this->assertSame($expected, $actual);
    }
}
