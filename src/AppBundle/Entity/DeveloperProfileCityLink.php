<?php

namespace AppBundle\Entity;

/**
 * DeveloperProfileCityLink
 */
class DeveloperProfileCityLink
{
    const MAIN = 1;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $type;

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
     * @param integer $type
     *
     * @return DeveloperProfileCityLink
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get main
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
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
