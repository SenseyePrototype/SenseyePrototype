<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileSearchCriteria;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\MultiMatch;

class ProfileSearchBuilder
{
    /**
     * @param ProfileSearchCriteria $criteria
     * @return Query
     */
    public function build(ProfileSearchCriteria $criteria)
    {
        $boolQuery = new BoolQuery();

        if ($criteria->getFulltext()) {
            $match = new MultiMatch();
            $match
                ->setQuery($criteria->getFulltext())
                ->setFields([
                    'title',
                    'description',
                ]);
            $boolQuery->addMust($match);
        }

        if ($criteria->getSalaryRange()->exists()) {
            $salary = new Query\Range();
            $param = array_filter([
                'gte' => $criteria->getSalaryRange()->getFrom(),
                'lte' => $criteria->getSalaryRange()->getTo(),
            ]);
            $salary->setParam('salary', $param);
            $boolQuery->addFilter($salary);
        }

        foreach ($criteria->getMultiMap() as $name => $list) {
            $param = new Query\Terms();

            $param->setTerms("$name.alias", array_column($list, 'alias'));

            $boolQuery->addFilter($param);
        }

        foreach ($criteria->getMustMap() as $name => $list) {
            foreach ($list as $item) {
                $param = new Query\Term();

                $param->setTerm("$name.alias", $item['alias']);

                $boolQuery->addFilter($param);
            }
        }

        return new Query($boolQuery);
    }
}
