<?php

namespace AppBundle\Component;

class ProfileSearchCriteria
{
    /**
     * @var string|null
     */
    private $fulltext;

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
     * @param string|null $fullText
     * @param array $multiMap
     * @param array $mustMap
     * @param Range|null $salaryRange
     */
    public function __construct($fullText, array $multiMap, array $mustMap, $salaryRange)
    {
        $this->fullText = $fullText;
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
