<?php

namespace Tests\AppBundle\Service;

use Elastica\Document;
use Elastica\Index;

class ProfileSearchServiceTest extends AbstractServiceTest
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

        $result = $index->search();

        $this->assertSame($profiles, [$result[0]->getSource()]);
    }

    protected function clearIndex(Index $index)
    {
        try {
            $index->delete();
        } catch (\Exception $e) {}
    }
}
