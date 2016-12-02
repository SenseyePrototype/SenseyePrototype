<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileSearchCriteria;
use Elastica\Client;

class ProfileSearcher
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ProfileSearcher constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function search(ProfileSearchCriteria $criteria)
    {
        $search = $this->client->getIndex('developer')->getType('profile');

        $resultSet = $search->search();

        $result = [];

        foreach ($resultSet as $item) {
            $result[] = $item->getSource();
        }

        return $result;
    }
}
