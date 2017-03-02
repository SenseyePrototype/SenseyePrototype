<?php

namespace AppBundle\Entity;

/**
 * DeveloperProfileCityLink
 */
class DeveloperProfileCityLink
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var boolean
     */
    private $main;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var \AppBundle\Entity\DeveloperProfile
     */
    private $developerProfile;

    /**
     * @var \AppBundle\Entity\City
     */
    private $city;


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
     * Set main
     *
     * @param boolean $main
     *
     * @return DeveloperProfileCityLink
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Get main
     *
     * @return boolean
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return DeveloperProfileCityLink
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
     * @return DeveloperProfileCityLink
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

    /**
     * Set developerProfile
     *
     * @param \AppBundle\Entity\DeveloperProfile $developerProfile
     *
     * @return DeveloperProfileCityLink
     */
    public function setDeveloperProfile(\AppBundle\Entity\DeveloperProfile $developerProfile)
    {
        $this->developerProfile = $developerProfile;

        return $this;
    }

    /**
     * Get developerProfile
     *
     * @return \AppBundle\Entity\DeveloperProfile
     */
    public function getDeveloperProfile()
    {
        return $this->developerProfile;
    }

    /**
     * Set city
     *
     * @param \AppBundle\Entity\City $city
     *
     * @return DeveloperProfileCityLink
     */
    public function setCity(\AppBundle\Entity\City $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \AppBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }
}
