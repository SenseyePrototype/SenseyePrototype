<?php

namespace AppBundle\Component;

class ProfileCounterResponse
{
    /**
     * @var int
     */
    private $count;

    /**
     * @var ProfileCriteriaAggregation
     */
    private $aggregation;

    /**
     * ProfileCounterResponse constructor.
     * @param int $count
     * @param ProfileCriteriaAggregation $aggregation
     */
    public function __construct($count, ProfileCriteriaAggregation $aggregation)
    {
        $this->count = $count;
        $this->aggregation = $aggregation;
    }

    public function getData()
    {
        return [
            'count' => $this->count,
            'multi' => $this->aggregation->getMulti(),
            'must' => $this->aggregation->getMust(),
            'range' => $this->aggregation->getRange(),
        ];
    }
}
