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
            $filter = $request->query->get($criteriaName);
            if (is_string($filter)) {
                $aliasSourceMap = array_column($availableList, null, 'alias');

                $requestAliases = explode(',', $filter);

                if ($intersect = array_intersect_key($aliasSourceMap, array_flip($requestAliases))) {
                    $resultMulti[$criteriaName] = array_values($intersect);
                }
            }
        }

        return new ProfileSearchCriteria($resultMulti, $this->getSalary($available->getRangeMap(), $request));
    }

    private function getSalary(array $rangeMap, Request $request)
    {
        $salary = $request->query->get('salary');

        if (isset($rangeMap['salary']) && is_string($salary)) {
            $range = explode('-', $salary);

            $sourceFrom = (int)array_shift($range);
            $sourceTo = (int)array_shift($range);

            $from = $rangeMap['salary']['from'] < $sourceFrom && $sourceFrom <= $rangeMap['salary']['to']
                ? $sourceFrom
                : null;

            $to = $sourceTo >= $from
                && $rangeMap['salary']['from'] <= $sourceTo
                && $sourceTo < $rangeMap['salary']['to']
                ? $sourceTo
                : null;

            return new Range($from, $to);
        }

        return new Range();
    }
}
