<?php

namespace AppBundle\Service;

use AppBundle\Component\Adapter\ElasticAdapter;
use AppBundle\Component\Profile;
use AppBundle\Component\ProfileSearchCriteria;
use AppBundle\Component\ProfileSearchResponse;
use Elastica\Client;
use Elastica\Result;
use ReenExeCubeTime\LightPaginator\CompleteFactory;

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
     * @var CompleteFactory
     */
    private $pagerFactory;

    /**
     * ProfileSearcher constructor.
     * @param Client $client
     * @param ProfileSearchBuilder $builder
     * @param CompleteFactory $pagerFactory
     */
    public function __construct(Client $client, ProfileSearchBuilder $builder, CompleteFactory $pagerFactory)
    {
        $this->client = $client;
        $this->builder = $builder;
        $this->pagerFactory = $pagerFactory;
    }

    /**
     * @param ProfileSearchCriteria $criteria
     * @param int $page
     * @param int $limit
     * @return ProfileSearchResponse
     */
    public function search(ProfileSearchCriteria $criteria, $page = 1, $limit = 7)
    {
        $searchable = $this->client->getIndex('developer')->getType('profile');

        $query = $this->builder->build($criteria);

        $pager = $this->pagerFactory->createSmartPager(
            new ElasticAdapter($searchable, $query),
            $page,
            $limit
        );

        $profiles = [];
        /* @var $result Result */
        foreach ($pager->getResults() as $result) {
            $profiles[] = new Profile($result->getSource());
        }

        return new ProfileSearchResponse($pager, $profiles);
    }
}
