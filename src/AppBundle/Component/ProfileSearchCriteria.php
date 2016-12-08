<?php

namespace AppBundle\Component;

class ProfileSearchCriteria
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
     * @var Range|null
     */
    private $salaryRange;

    /**
     * ProfileSearchCriteria constructor.
     * @param array $multiMap
     * @param array $mustMap
     * @param Range|null $salaryRange
     */
    public function __construct(array $multiMap, array $mustMap, $salaryRange)
    {
        $this->multiMap = $multiMap;
        $this->mustMap = $mustMap;
        $this->salaryRange = $salaryRange;
    }

    /**
     * @return array
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
     * @return Range|null
     */
    public function getSalaryRange()
    {
        return $this->salaryRange;
    }
}
