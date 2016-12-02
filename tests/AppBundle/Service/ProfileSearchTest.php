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

        $profiles = [
            [
                'hash_code' => md5(1),
                'title' => 'PHP developer',
                'cities' => [
                    [
                        'alias' => 'kiev',
                        'name' => 'Київ',
                    ]
                ],
                'description' => 'Develop current project',
                'salary' => 5000,
                'experience' => 5,
                'profiles' => [
                    [
                        'alias' => 'github',
                        'name' => 'GitHub',
                        'link' => 'https://github.com/SenseyePrototype',
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
                ]
            ]
        ];

        foreach ($profiles as $profile) {
            $type->addDocument(new Document($profile['hash_code'], $profile));
        }

        $index->refresh();

        $searcher = $this->container->get('senseye.profile.searcher');
        $this->assertSame($profiles, $searcher->search(new ProfileSearchCriteria([], new Range())));
    }

    protected function clearIndex(Index $index)
    {
        try {
            $index->delete();
        } catch (\Exception $e) {}
    }
}
