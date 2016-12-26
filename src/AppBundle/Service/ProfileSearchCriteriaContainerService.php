<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileAvailableCriteria;
use AppBundle\Component\ProfileAvailableCriteriaContainer;
use AppBundle\Component\ProfileSearchCriteria;

class ProfileSearchCriteriaContainerService
{
    public function merge(ProfileAvailableCriteria $availableCriteria, ProfileSearchCriteria $searchCriteria)
    {
        return new ProfileAvailableCriteriaContainer(
            $availableCriteria,
            $searchCriteria,
            array_merge(
                $this->mergeMap($availableCriteria->getMultiMap(), $searchCriteria->getMultiMap()),
                $this->mergeMap($availableCriteria->getMustMap(), $searchCriteria->getMustMap())
            )
        );
    }

    private function mergeMap(array $availableMap, array $selectedMap)
    {
        $result = [];

        foreach ($availableMap as $criteriaName => $criteriaList) {
            $selected = $selectedMap[$criteriaName] ?? [];
            $selectedAliasMap = array_column($selected, null, 'alias');
            $availableAliasMap = array_column($criteriaList, null, 'alias');

            $merge = [];

            foreach ($availableAliasMap as $alias => $criteria) {
                $criteria['checked'] = isset($selectedAliasMap[$alias]);
                $merge[] = $criteria;
            }

            $result[$criteriaName] = $merge;
        }

        return $result;
    }
}
