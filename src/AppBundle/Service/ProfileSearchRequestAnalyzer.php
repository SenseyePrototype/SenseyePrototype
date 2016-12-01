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
            if ($filter = $request->query->get($criteriaName)) {
                $aliases = array_column($availableList, null, 'alias');

                $resultMulti[$criteriaName] = [
                    $aliases[$filter]
                ];
            }
        }

        return new ProfileSearchCriteria($resultMulti, new Range());
    }
}
