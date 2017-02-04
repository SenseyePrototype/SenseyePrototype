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
     * @var boolean
     */
    private $published;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $skillLinks;

    /**
     * @var \AppBundle\Entity\User
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->skillLinks = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set published
     *
     * @param boolean $published
     *
     * @return DeveloperProfile
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Add skillLink
     *
     * @param \AppBundle\Entity\DeveloperProfileSkillLink $skillLink
     *
     * @return DeveloperProfile
     */
    public function addSkillLink(\AppBundle\Entity\DeveloperProfileSkillLink $skillLink)
    {
        $this->skillLinks[] = $skillLink;

        return $this;
    }

    /**
     * Remove skillLink
     *
     * @param \AppBundle\Entity\DeveloperProfileSkillLink $skillLink
     */
    public function removeSkillLink(\AppBundle\Entity\DeveloperProfileSkillLink $skillLink)
    {
        $this->skillLinks->removeElement($skillLink);
    }

    /**
     * Get skillLinks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkillLinks()
    {
        return $this->skillLinks;
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

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return DeveloperProfile
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return DeveloperProfile
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
