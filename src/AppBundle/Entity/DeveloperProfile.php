<?php

namespace AppBundle\Entity;

/**
 * DeveloperProfile
 */
class DeveloperProfile
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $salary;

    /**
     * @var integer
     */
    private $experience;

    /**
     * @var string
     */
    private $assert;

    /**
     * @var string
     */
    private $expect;

    /**
     * @var \AppBundle\Entity\User
     */
    private $user;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return DeveloperProfile
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return DeveloperProfile
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set salary
     *
     * @param integer $salary
     *
     * @return DeveloperProfile
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return integer
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * Set experience
     *
     * @param integer $experience
     *
     * @return DeveloperProfile
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return integer
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * Set assert
     *
     * @param string $assert
     *
     * @return DeveloperProfile
     */
    public function setAssert($assert)
    {
        $this->assert = $assert;

        return $this;
    }

    /**
     * Get assert
     *
     * @return string
     */
    public function getAssert()
    {
        return $this->assert;
    }

    /**
     * Set expect
     *
     * @param string $expect
     *
     * @return DeveloperProfile
     */
    public function setExpect($expect)
    {
        $this->expect = $expect;

        return $this;
    }

    /**
     * Get expect
     *
     * @return string
     */
    public function getExpect()
    {
        return $this->expect;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return DeveloperProfile
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}

