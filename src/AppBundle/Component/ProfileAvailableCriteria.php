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
    private $mustMap;

    /**
     * @var array
     */
    private $rangeMap;

    /**
     * ProfileAvailableCriteria constructor.
     * @param array $multiMap
     * @param array $mustMap
     * @param array $rangeMap
     */
    public function __construct(array $multiMap, array $mustMap, array $rangeMap)
    {
        $this->multiMap = $multiMap;
        $this->mustMap = $mustMap;
        $this->rangeMap = $rangeMap;
    }

    /**
     * @return mixed
     */
    public function getMultiMap()
    {
        return $this->multiMap;
    }

    /**
     * @return array
     */
    public function getMustMap()
    {
        return $this->mustMap;
    }

    /**
     * @return mixed
     */
    public function getRangeMap()
    {
        return $this->rangeMap;
    }
}
