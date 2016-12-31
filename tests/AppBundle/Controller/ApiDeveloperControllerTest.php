<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ApiDeveloperControllerTest extends WebTestCase
{
    public function testCount()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/developers/count.json');

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

}
