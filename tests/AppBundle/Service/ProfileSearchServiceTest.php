<?php

namespace Tests\AppBundle\Service;

use Elastica\Document;

class ProfileSearchServiceTest extends AbstractServiceTest
{
    public function test()
    {
        $client = $this->container->get('senseye.elasticsearch.client');

        $index = $client->getIndex('developer');
        $type = $index->getType('profile');

        $data = [
            'title' => 'PHP developer',
            'description' => 'Develop current project'
        ];

        $type->addDocument(new Document(1, $data));

        $index->refresh();

        $result = $index->search();

        $this->assertSame($data, $result[0]->getSource());
    }
}
