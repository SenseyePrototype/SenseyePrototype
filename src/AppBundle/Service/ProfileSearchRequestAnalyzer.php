<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileAvailableCriteria;
use AppBundle\Component\ProfileSearchCriteria;
use AppBundle\Component\Range;
use Symfony\Component\HttpFoundation\Request;

class ProfileSearchRequestAnalyzer
{
    public function analyze(ProfileAvailableCriteria $available, Request $request)
    {
        $resultMulti = [];

        foreach ($available->getMultiMap() as $criteriaName => $availableList) {
            if ($filterString = $request->query->get($criteriaName)) {
                $aliasSourceMap = array_column($availableList, null, 'alias');

                $requestAliases = explode(',', $filterString);

                if ($intersect = array_intersect_key($aliasSourceMap, array_flip($requestAliases))) {
                    $resultMulti[$criteriaName] = array_values($intersect);
                }
            }
        }

        return new ProfileSearchCriteria($resultMulti, new Range());
    }
}
