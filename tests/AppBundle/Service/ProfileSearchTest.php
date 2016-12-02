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

        $emptySearchCriteria = new ProfileSearchCriteria([], new Range());
        $searcher = $this->container->get('senseye.profile.searcher');

        $architect = [
            'hash_code' => md5(1),
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
            ]
        ];

        $designer = [
            'hash_code' => md5(2),
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
            ]
        ];

        $profiles = [
            $architect,
            $designer,
        ];

        foreach ($profiles as $profile) {
            $type->addDocument(new Document($profile['hash_code'], $profile));
        }

        $index->refresh();

        $this->assertSame(array_reverse($profiles), $searcher->search($emptySearchCriteria));

        foreach ($this->getBothCriteria() as $criteria) {
            $this->assertSame(array_reverse($profiles), $searcher->search($criteria));
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
        yield new ProfileSearchCriteria([], new Range(5000, 5000));

        yield new ProfileSearchCriteria(
            [
                'skills' => [
                    [
                        'alias' => 'php',
                    ],
                ]
            ],
            new Range()
        );

        yield new ProfileSearchCriteria(
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
                'profiles' => [
                    [
                        'alias' => 'github',
                    ]
                ]
            ],
            new Range(5000, 5000)
        );
    }

    private function getBothCriteria()
    {
        yield new ProfileSearchCriteria(
            [
                'skills' => [
                    [
                        'alias' => 'git'
                    ],
                ],
                'profiles' => [
                    [
                        'alias' => 'github',
                    ]
                ]
            ],
            new Range(1000, 5000)
        );
    }
}
