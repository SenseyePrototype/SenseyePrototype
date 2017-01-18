<?php

namespace AppBundle\Component;

class ProfileAvailableCriteriaContainer
{
    /**
     * @var ProfileSearchCriteria
     */
    private $selected;

    /**
     * @var ProfileCriteriaAggregation
     */
    private $aggregation;

    /**
     * @var array
     */
    private $multi;

    /**
     * ProfileAvailableCriteriaContainer constructor.
     * @param ProfileSearchCriteria $selected
     * @param ProfileCriteriaAggregation $aggregation
     * @param array $multi
     */
    public function __construct(ProfileSearchCriteria $selected, ProfileCriteriaAggregation $aggregation, array $multi)
    {
        $this->selected = $selected;
        $this->aggregation = $aggregation;
        $this->multi = $multi;
    }

    /**
     * @return null|string
     */
    public function getFulltext()
    {
        return $this->selected->getFulltext();
    }

    /**
     * @return array
     */
    public function getCities()
    {
        return $this->multi['cities'];
    }

    /**
     * @return array
     */
    public function getExperience()
    {
        return $this->aggregation->getRange()['experience'];
    }

    /**
     * @return Range
     */
    public function getSelectedExperience()
    {
        return $this->selected->getExperienceRange();
    }

    /**
     * @return array
     */
    public function getSalary()
    {
        return $this->aggregation->getRange()['salary'];
    }

    /**
     * @return Range
     */
    public function getSelectedSalary()
    {
        return $this->selected->getSalaryRange();
    }

    /**
     * @return array
     */
    public function getSkills()
    {
        return $this->multi['skills'];
    }
}
