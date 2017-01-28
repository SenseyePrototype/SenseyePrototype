<?php

namespace AppBundle\Entity;

/**
 * DeveloperProfileSkillLink
 */
class DeveloperProfileSkillLink
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $position;

    /**
     * @var integer
     */
    private $score;

    /**
     * @var integer
     */
    private $experience;

    /**
     * @var \AppBundle\Entity\DeveloperProfile
     */
    private $developerProfile;

    /**
     * @var \AppBundle\Entity\Skill
     */
    private $skill;


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
     * Set position
     *
     * @param integer $position
     *
     * @return DeveloperProfileSkillLink
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return DeveloperProfileSkillLink
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set experience
     *
     * @param integer $experience
     *
     * @return DeveloperProfileSkillLink
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
     * Set developerProfile
     *
     * @param \AppBundle\Entity\DeveloperProfile $developerProfile
     *
     * @return DeveloperProfileSkillLink
     */
    public function setDeveloperProfile(\AppBundle\Entity\DeveloperProfile $developerProfile = null)
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
     * Set skill
     *
     * @param \AppBundle\Entity\Skill $skill
     *
     * @return DeveloperProfileSkillLink
     */
    public function setSkill(\AppBundle\Entity\Skill $skill = null)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return \AppBundle\Entity\Skill
     */
    public function getSkill()
    {
        return $this->skill;
    }
}
