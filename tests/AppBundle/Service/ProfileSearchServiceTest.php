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
                'description' => 'Develop current project'
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
