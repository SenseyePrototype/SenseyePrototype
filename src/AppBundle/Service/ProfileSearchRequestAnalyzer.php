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
        return new ProfileSearchCriteria(
            $request->query->get('search'),
            $this->intersect($available->getMultiMap(), $request),
            $this->intersect($available->getMustMap(), $request),
            $this->getRange($available->getRangeMap(), $request, 'salary'),
            $this->getRange($available->getRangeMap(), $request, 'experience')
        );
    }

    public function analyzeCity(ProfileAvailableCriteria $available, $cityAlias)
    {
        $multi = $available->getMultiMap();
        $cities = array_column($multi['cities'], null, 'alias');

        if (empty($cities[$cityAlias])) {
            return null;
        }

        $range = new Range();

        return new ProfileSearchCriteria(
            null,
            [
                'cities' => [
                    $cities[$cityAlias]
                ]
            ],
            [],
            $range,
            $range
        );
    }

    /**
     * @param array $map
     * @param Request $request
     * @return array
     */
    private function intersect(array $map, Request $request)
    {
        $result = [];

        foreach ($map as $criteriaName => $availableList) {
            $filter = $request->query->get($criteriaName);
            if (is_string($filter)) {
                $aliasSourceMap = array_column($availableList, null, 'alias');

                $requestAliases = explode(',', $filter);

                if ($intersect = array_intersect_key($aliasSourceMap, array_flip($requestAliases))) {
                    $result[$criteriaName] = array_values($intersect);
                }
            }
        }

        return $result;
    }

    /**
     * @param array $rangeMap
     * @param Request $request
     * @param $key
     * @return Range
     */
    private function getRange(array $rangeMap, Request $request, $key)
    {
        $salary = $request->query->get($key);

        if (isset($rangeMap[$key]) && is_string($salary)) {
            $range = explode('-', $salary);

            $sourceFrom = (int)array_shift($range);
            $sourceTo = (int)array_shift($range);

            $from = $rangeMap[$key]['from'] < $sourceFrom && $sourceFrom <= $rangeMap[$key]['to']
                ? $sourceFrom
                : null;

            $to = $sourceTo >= $from
                && $rangeMap[$key]['from'] <= $sourceTo
                && $sourceTo < $rangeMap[$key]['to']
                ? $sourceTo
                : null;

            return new Range($from, $to);
        }

        return new Range();
    }
}
