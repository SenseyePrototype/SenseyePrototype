<?php

namespace AppBundle\Component;

class Profile implements ProfileInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * Profile constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getId()
    {
        return $this->data['id'];
    }

    public function getTitle()
    {
        return $this->data['title'];
    }

    public function getDescription()
    {
        return $this->data['description'];
    }

    public function getLink()
    {
        return $this->data['link'];
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

    public function getAssert()
    {
        return $this->data['assert'];
    }

    public function getExpect()
    {
        return $this->data['expect'];
    }

    public function getCreated()
    {
        return new \DateTime($this->data['created']);
    }

    public function isInternal()
    {
        return $this->getLink() === null;
    }
}
