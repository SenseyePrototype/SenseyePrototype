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
     * @var array
     */
    private $multi;

    /**
     * ProfileAvailableCriteriaContainer constructor.
     * @param ProfileAvailableCriteria $available
     * @param ProfileSearchCriteria $selected
     * @param array $multi
     */
    public function __construct(ProfileAvailableCriteria $available, ProfileSearchCriteria $selected, array $multi)
    {
        $this->available = $available;
        $this->selected = $selected;
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
        return $this->multi['skills'];
    }
}
