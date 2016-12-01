<?php

namespace AppBundle\Component;

class ProfileAvailableCriteria
{
    /**
     * @var array
     */
    private $rangeMap;

    /**
     * @var array 
     */
    private $multiMap;

    /**
     * ProfileAvailableCriteria constructor.
     * @param array $rangeMap
     * @param array $multiMap
     */
    public function __construct(array $rangeMap, array $multiMap)
    {
        $this->rangeMap = $rangeMap;
        $this->multiMap = $multiMap;
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
