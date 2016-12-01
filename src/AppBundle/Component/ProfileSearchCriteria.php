<?php

namespace AppBundle\Component;

class ProfileSearchCriteria
{
    /**
     * @var array
     */
    private $multiMap;

    /**
     * @var Range|null
     */
    private $salaryRange;

    /**
     * ProfileSearchCriteria constructor.
     * @param array $multiMap
     * @param Range|null $salaryRange
     */
    public function __construct(array $multiMap, $salaryRange)
    {
        $this->multiMap = $multiMap;
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
     * @return Range|null
     */
    public function getSalaryRange()
    {
        return $this->salaryRange;
    }
}
