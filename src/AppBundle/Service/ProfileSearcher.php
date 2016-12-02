<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileSearchCriteria;
use Elastica\Client;
use Elastica\Query;
use Elastica\Query\BoolQuery;

class ProfileSearcher
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ProfileSearcher constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function search(ProfileSearchCriteria $criteria)
    {
        $searchable = $this->client->getIndex('developer')->getType('profile');

        $boolQuery = new BoolQuery();

        if ($criteria->getSalaryRange()->exists()) {
            $salary = new Query\Range();
            $param = array_filter([
                'gte' => $criteria->getSalaryRange()->getFrom(),
                'lte' => $criteria->getSalaryRange()->getTo(),
            ]);
            $salary->setParam('salary', $param);
            $boolQuery->addFilter($salary);
        }

        $query = new Query($boolQuery);

        $resultSet = $searchable->search($query);

        $result = [];

        foreach ($resultSet as $item) {
            $result[] = $item->getSource();
        }

        return $result;
    }
}
