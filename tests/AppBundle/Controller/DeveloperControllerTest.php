<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeveloperControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $client->request('GET', '/developers');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertSame(
            [
                'count' => 8
            ],
            json_decode($client->getResponse()->getContent(), true)
        );
    }

}
