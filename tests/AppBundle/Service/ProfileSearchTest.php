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

        $searcher = $this->container->get('senseye.profile.searcher');
        $this->assertSame(array_reverse($profiles), $searcher->search(new ProfileSearchCriteria([], new Range())));
    }

    protected function clearIndex(Index $index)
    {
        try {
            $index->delete();
        } catch (\Exception $e) {}
    }
}
