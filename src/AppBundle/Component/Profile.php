<?php

namespace AppBundle\Component;

class Profile implements ProfileInterface
{
    /**
     * @var
     */
    private $data;

    /**
     * Profile constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getTitle()
    {
        return $this->data['title'];
    }

    public function getDescription()
    {
        return $this->data['description'];
    }

    public function getSkills()
    {
        return $this->data['skills'];
    }

    public function getCities()
    {
        return $this->data['cities'];
    }

    public function getSalary()
    {
        return $this->data['salary'];
    }

    public function getExperience()
    {
        return $this->data['experience'];
    }

    public function getCreated()
    {
        return new \DateTime($this->data['created']);
    }
}
