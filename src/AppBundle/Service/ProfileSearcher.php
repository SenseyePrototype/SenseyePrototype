<?php

namespace AppBundle\Service;

use AppBundle\Component\Adapter\ElasticAdapter;
use AppBundle\Component\Profile;
use AppBundle\Component\ProfileSearchCriteria;
use AppBundle\Component\ProfileSearchResponse;
use Elastica\Result;
use ReenExeCubeTime\LightPaginator\CompleteFactory;

class ProfileSearcher
{
    /**
     * @var DeveloperIndexService
     */
    private $indexService;

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
     * @param DeveloperIndexService $indexService
     * @param ProfileSearchBuilder $builder
     * @param CompleteFactory $pagerFactory
     */
    public function __construct(DeveloperIndexService $indexService, ProfileSearchBuilder $builder, CompleteFactory $pagerFactory)
    {
        $this->indexService = $indexService;
        $this->builder = $builder;
        $this->pagerFactory = $pagerFactory;
    }

    /**
     * @param ProfileSearchCriteria $criteria
     * @param int $page
     * @param int $limit
     * @return ProfileSearchResponse
     */
    public function search(ProfileSearchCriteria $criteria, $page, $limit)
    {
        $searchable = $this->indexService->getProfile();

        $query = $this->builder->buildSearchQuery($criteria);

        $offset = ($page - 1) * $limit;

        if ($offset >= 10000) {
            $page = 1;
        }

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
