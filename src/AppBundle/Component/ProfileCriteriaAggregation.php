<?php

namespace AppBundle\Component;

class ProfileCriteriaAggregation
{
    /**
     * @var array
     */
    private $multi;

    /**
     * @var array
     */
    private $must;

    /**
     * @var array
     */
    private $range;

    /**
     * ProfileCriteriaAggregation constructor.
     * @param array $multi
     * @param array $must
     * @param array $range
     */
    public function __construct(array $multi, array $must, array $range)
    {
        $this->multi = $multi;
        $this->must = $must;
        $this->range = $range;
    }

    /**
     * @return array
     */
    public function getMulti(): array
    {
        return $this->multi;
    }

    /**
     * @return array
     */
    public function getMust(): array
    {
        return $this->must;
    }

    /**
     * @return array
     */
    public function getRange(): array
    {
        return $this->range;
    }
}
