<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MainControllerListTest extends WebTestCase
{
    /**
     * @dataProvider dataProvider
     * @param $path
     */
    public function testList($path)
    {
        $client = static::createClient();

        $client->request('GET', $path);

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
    }

    public function dataProvider()
    {
        return [
            ['/'],
//            ['/ru'],
            ['/developers'],
//            ['/ru/developers'],
        ];
    }
}
