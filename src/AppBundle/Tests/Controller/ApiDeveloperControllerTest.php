<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiDeveloperControllerTest extends WebTestCase
{
    public function testCount()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/v1/developer/count.json');
    }

}
