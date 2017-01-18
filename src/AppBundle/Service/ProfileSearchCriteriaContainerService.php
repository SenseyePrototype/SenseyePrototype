<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileAvailableCriteria;
use AppBundle\Component\ProfileAvailableCriteriaContainer;
use AppBundle\Component\ProfileCriteriaAggregation;
use AppBundle\Component\ProfileSearchCriteria;

class ProfileSearchCriteriaContainerService
{
    public function merge(
        ProfileAvailableCriteria $availableCriteria,
        ProfileSearchCriteria $searchCriteria,
        ProfileCriteriaAggregation $aggregation
    ) {
        return new ProfileAvailableCriteriaContainer(
            $searchCriteria,
            $aggregation,
            array_merge(
                $this->mergeMap(
                    $availableCriteria->getMultiMap(),
                    $searchCriteria->getMultiMap(),
                    $aggregation->getMulti()
                ),
                $this->mergeMap(
                    $availableCriteria->getMustMap(),
                    $searchCriteria->getMustMap(),
                    $aggregation->getMust()
                )
            )
        );
    }

    private function mergeMap(array $availableMap, array $selectedMap, array $countMap)
    {
        $result = [];

        foreach ($availableMap as $criteriaName => $criteriaList) {
            $selected = $selectedMap[$criteriaName] ?? [];
            $selectedAliasMap = array_column($selected, null, 'alias');
            $availableAliasMap = array_column($criteriaList, null, 'alias');

            $merge = [];

            foreach ($availableAliasMap as $alias => $criteria) {
                $criteria['checked'] = isset($selectedAliasMap[$alias]);
                $criteria['count'] = $countMap[$criteriaName][$alias] ?? 0;
                $merge[] = $criteria;
            }

            $result[$criteriaName] = $merge;
        }

        return $result;
    }
}
