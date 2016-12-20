<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileSearchCriteria;
use AppBundle\Component\ProfileSearchResponse;
use Elastica\Client;

class ProfileSearcher
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var ProfileSearchBuilder
     */
    private $builder;

    /**
     * ProfileSearcher constructor.
     * @param Client $client
     * @param ProfileSearchBuilder $builder
     */
    public function __construct(Client $client, ProfileSearchBuilder $builder)
    {
        $this->client = $client;
        $this->builder = $builder;
    }

    /**
     * @param ProfileSearchCriteria $criteria
     * @return ProfileSearchResponse
     */
    public function search(ProfileSearchCriteria $criteria)
    {
        return new ProfileSearchResponse();
    }
}
