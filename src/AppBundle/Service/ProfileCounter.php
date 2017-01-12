<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileAvailableCriteria;
use AppBundle\Component\ProfileCounterResponse;
use AppBundle\Component\ProfileSearchCriteria;

class ProfileCounter
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
     * ProfileCounter constructor.
     * @param DeveloperIndexService $indexService
     * @param ProfileSearchBuilder $builder
     */
    public function __construct(DeveloperIndexService $indexService, ProfileSearchBuilder $builder)
    {
        $this->indexService = $indexService;
        $this->builder = $builder;
    }

    public function getCounter(ProfileAvailableCriteria $available, ProfileSearchCriteria $criteria)
    {
        $searchable = $this->indexService->getProfile();

        $query = $this->builder->buildSearchQuery($criteria);

        $count = $searchable->count($query);

        $filterNameMap = $this->builder->getNameFilterMap($criteria);

        $query = $this->builder->buildCountQuery($criteria);

        $aggs = [];
        foreach (array_keys($available->getMultiMap()) as $name) {
            $filter = $filterNameMap;
            unset($filter[$name]);
            $aggs[$name] = $this->getAggregation($name, $filter);
        }
        foreach (array_keys($available->getMustMap()) as $name) {
            $aggs[$name] = $this->getAggregation($name, $filterNameMap);
        }

        $query->setParam('aggs', $aggs);

        $aggregations = $searchable->search($query)->getAggregations();

        $multi = [];
        foreach (array_keys($available->getMultiMap()) as $name) {
            $multi[$name] = array_column($aggregations[$name]['buckets'], 'doc_count', 'key');
        }

        $must = [];
        foreach (array_keys($available->getMustMap()) as $name) {
            $aggregation = $aggregations[$name]['buckets'] ?? $aggregations[$name][$name]['buckets'];
            $must[$name] = array_column($aggregation, 'doc_count', 'key');
        }

        return new ProfileCounterResponse($count, $multi, $must, []);
    }

    private function getAggregation($name, array $filter)
    {
        $terms = [
            'terms' => [
                'field' => "$name.alias",
            ],
        ];

        if ($filter) {
            return [
                'filter' => [
                    'bool' => [
                        'must' => array_values($filter),
                    ],
                ],
                'aggs' => [
                    $name => $terms,
                ],
            ];
        }

        return $terms;
    }
}
