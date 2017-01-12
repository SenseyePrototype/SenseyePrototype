<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileCounterResponse;
use Elastica\Query;
use Symfony\Component\HttpFoundation\Request;

class ProfileCounter
{
    /**
     * @var ProfileAvailableCriteriaRepository
     */
    private $criteriaRepository;

    /**
     * @var ProfileSearchRequestAnalyzer
     */
    private $requestAnalyzer;

    /**
     * @var DeveloperIndexService
     */
    private $indexService;

    /**
     * @var ProfileSearchBuilder
     */
    private $builder;

    /**
     * ProfileCounter constructor.
     * @param ProfileAvailableCriteriaRepository $criteriaRepository
     * @param ProfileSearchRequestAnalyzer $requestAnalyzer
     * @param DeveloperIndexService $indexService
     * @param ProfileSearchBuilder $builder
     */
    public function __construct(ProfileAvailableCriteriaRepository $criteriaRepository, ProfileSearchRequestAnalyzer $requestAnalyzer, DeveloperIndexService $indexService, ProfileSearchBuilder $builder)
    {
        $this->criteriaRepository = $criteriaRepository;
        $this->requestAnalyzer = $requestAnalyzer;
        $this->indexService = $indexService;
        $this->builder = $builder;
    }

    public function getCounter(Request $request)
    {
        $available = $this->criteriaRepository->get();

        $criteria = $this->requestAnalyzer->analyze($available, $request);

        $searchable = $this->indexService->getProfile();

        $query = $this->builder->buildSearchQuery($criteria);

        $count = $searchable->count($query);

//        $filterNameMap = $this->builder->getNameFilterMap($criteria);

        $query = new Query();

        $query->setParam('aggs', [
            'cities' => [
                'terms' => [
                    'field' => 'cities.alias',
                ],
            ],
            'skills' => [
                'terms' => [
                    'field' => 'skills.alias',
                ],
            ],
        ]);

        $aggregations = $searchable->search($query)->getAggregations();

        $multi = [];
        foreach (array_keys($available->getMultiMap()) as $name) {
            $multi[$name] = array_column($aggregations[$name]['buckets'], 'doc_count', 'key');
        }

        $must = [];
        foreach (array_keys($available->getMustMap()) as $name) {
            $must[$name] = array_column($aggregations[$name]['buckets'], 'doc_count', 'key');
        }

        return new ProfileCounterResponse($count, $multi, $must, []);
    }
}
