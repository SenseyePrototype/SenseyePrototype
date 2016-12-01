<?php

namespace AppBundle\Component;

class ProfileAvailableCriteria
{
    /**
     * @var array
     */
    private $multiMap;

    /**
     * @var array
     */
    private $rangeMap;

    /**
     * ProfileAvailableCriteria constructor.
     * @param array $multiMap
     * @param array $rangeMap
     */
    public function __construct(array $multiMap, array $rangeMap)
    {
        $this->multiMap = $multiMap;
        $this->rangeMap = $rangeMap;
    }

    /**
     * @return mixed
     */
    public function getRangeMap()
    {
        return $this->rangeMap;
    }

    /**
     * @return mixed
     */
    public function getMultiMap()
    {
        return $this->multiMap;
    }
}
