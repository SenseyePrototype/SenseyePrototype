<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileAvailableCriteria;
use AppBundle\Component\ProfileCounterResponse;
use AppBundle\Component\ProfileCriteriaAggregation;
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
        $query = $this->builder->buildSearchQuery($criteria);

        $count = $this->indexService->getProfile()->count($query);

        return new ProfileCounterResponse(
            $count,
            $this->getAggregation($available, $criteria)
        );
    }

    public function getAggregation(ProfileAvailableCriteria $available, ProfileSearchCriteria $criteria)
    {
        $filterNameMap = $this->builder->getNameFilterMap($criteria);

        $query = $this->builder->buildCountQuery($criteria);

        $aggs = [];
        foreach (array_keys($available->getMultiMap()) as $name) {
            $filter = $filterNameMap;
            unset($filter[$name]);
            $aggs[$name] = $this->getAggregationTerms($name, $filter);
        }
        foreach (array_keys($available->getMustMap()) as $name) {
            $aggs[$name] = $this->getAggregationTerms($name, $filterNameMap);
        }

        foreach (array_keys($available->getRangeMap()) as $name) {
            $filter = $filterNameMap;
            unset($filter[$name]);
            $aggs[$name] = $this->getAggregationRange($name, $filter);
        }

        $query->setParam('aggs', $aggs);

        $aggregations = $this->indexService->getProfile()->search($query)->getAggregations();

        $multi = [];
        foreach (array_keys($available->getMultiMap()) as $name) {
            $aggregation = $aggregations[$name]['buckets'] ?? $aggregations[$name][$name]['buckets'];
            $multi[$name] = array_column($aggregation, 'doc_count', 'key');
        }

        $must = [];
        foreach (array_keys($available->getMustMap()) as $name) {
            $aggregation = $aggregations[$name]['buckets'] ?? $aggregations[$name][$name]['buckets'];
            $must[$name] = array_column($aggregation, 'doc_count', 'key');
        }

        $range = [];
        foreach ($available->getRangeMap() as $name => $availableRange) {
            $aggregation = $aggregations[$name][$name] ?? $aggregations[$name];
            $range[$name] = [
                'from' => (int)$aggregation['min'] ?: $availableRange['from'],
                'to' => (int)$aggregation['max'] ?: $availableRange['to'],
            ];
        }

        return new ProfileCriteriaAggregation($multi, $must, $range);
    }

    private function getAggregationTerms($name, array $filter)
    {
        $terms = [
            'terms' => [
                'field' => "$name.alias",
                'size' => 1000,
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

    private function getAggregationRange($name, array $filter)
    {
        $stats = [
            'stats' => [
                'field' => $name,
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
                    $name => $stats,
                ],
            ];
        }

        return $stats;
    }
}
