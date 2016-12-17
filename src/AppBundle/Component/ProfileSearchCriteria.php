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
     * @var Range
     */
    private $salaryRange;

    /**
     * @var Range
     */
    private $experienceRange;

    /**
     * ProfileSearchCriteria constructor.
     * @param $fullText
     * @param array $multiMap
     * @param array $mustMap
     * @param Range $salaryRange
     * @param Range $experienceRange
     */
    public function __construct(
        $fullText,
        array $multiMap,
        array $mustMap,
        Range $salaryRange,
        Range $experienceRange
    ) {
        $this->fulltext = $fullText;
        $this->multiMap = $multiMap;
        $this->mustMap = $mustMap;
        $this->salaryRange = $salaryRange;
        $this->experienceRange = $experienceRange;
    }

    /**
     * @return null|string
     */
    public function getFulltext()
    {
        return $this->fulltext;
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
     * @return Range
     */
    public function getSalaryRange()
    {
        return $this->salaryRange;
    }

    /**
     * @return Range
     */
    public function getExperienceRange()
    {
        return $this->experienceRange;
    }
}
