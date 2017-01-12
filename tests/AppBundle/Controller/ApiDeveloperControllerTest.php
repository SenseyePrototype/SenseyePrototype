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

        $this->assertSame(
            [
                'count' => 8,
                'multi' => [
                    'cities' => [
                        'kiev' => 8,
                        'lviv' => 2,
                        'odessa' => 1,
                    ],
                ],
                'must' => [
                    'skills' => [
                        'git' => 8,
                        'java' => 2,
                        'javascript' => 2,
                        'cpp' => 1,
                        'css' => 1,
                        'elasticsearch' => 1,
                        'golang' => 1,
                        'html' => 1,
                        'less' => 1,
                        'mysql' => 1,
                        'php' => 1,
                        'phpunit' => 1,
                        'redis' => 1,
                        'sass' => 1,
                        'swift' => 1,
                        'symfony' => 1,
                    ],
                ],
                'range' => [],
            ],
            json_decode($client->getResponse()->getContent(), true)
        );
    }
}
