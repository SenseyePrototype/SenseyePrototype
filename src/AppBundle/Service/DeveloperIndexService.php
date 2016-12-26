<?php

namespace AppBundle\Service;

use Elastica\Client;

class DeveloperIndexService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * IndexService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return \Elastica\Type
     */
    public function getProfile()
    {
        return $this->client->getIndex('developer')->getType('profiles');
    }

    /**
     * @return \Elastica\Type
     */
    public function getFilter()
    {
        return $this->client->getIndex('developer')->getType('filter');
    }
}