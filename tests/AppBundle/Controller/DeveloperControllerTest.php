<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class DeveloperControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $client->request('GET', '/developers');

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }
}
