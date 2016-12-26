<?php

namespace AppBundle\Component;

class ProfileAvailableCriteriaContainer
{
    /**
     * @var ProfileAvailableCriteria
     */
    private $available;

    /**
     * @var ProfileSearchCriteria
     */
    private $selected;

    /**
     * ProfileAvailableCriteriaContainer constructor.
     * @param ProfileAvailableCriteria $available
     * @param ProfileSearchCriteria $selected
     */
    public function __construct(ProfileAvailableCriteria $available, ProfileSearchCriteria $selected)
    {
        $this->available = $available;
        $this->selected = $selected;
    }

    /**
     * @return array
     */
    public function getCities()
    {
        return $this->available->getMultiMap()['cities'];
    }

    /**
     * @return array
     */
    public function getExperience()
    {
        return $this->available->getRangeMap()['experience'];
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
        return $this->available->getRangeMap()['salary'];
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
        return $this->available->getMustMap()['skills'];
    }
}
