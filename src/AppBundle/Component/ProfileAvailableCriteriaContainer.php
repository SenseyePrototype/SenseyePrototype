<?php

namespace AppBundle\Component;

class ProfileAvailableCriteriaContainer
{
    /**
     * @var ProfileAvailableCriteria
     */
    private $criteria;

    /**
     * ProfileAvailableCriteriaGetter constructor.
     * @param ProfileAvailableCriteria $criteria
     */
    public function __construct(ProfileAvailableCriteria $criteria)
    {
        $this->criteria = $criteria;
    }

    /**
     * @return array
     */
    public function getCities()
    {
        return $this->criteria->getMultiMap()['cities'];
    }

    /**
     * @return array
     */
    public function getExperience()
    {
        return $this->criteria->getRangeMap()['experience'];
    }

    /**
     * @return array
     */
    public function getSalary()
    {
        return $this->criteria->getRangeMap()['salary'];
    }

    /**
     * @return array
     */
    public function getSkills()
    {
        return $this->criteria->getMustMap()['skills'];
    }
}
