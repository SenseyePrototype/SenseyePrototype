<?php

namespace AppBundle\Entity;

/**
 * SkillSynonym
 */
class SkillSynonym
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $alias;

    /**
     * @var string
     */
    private $synonym;


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
     * Set alias
     *
     * @param string $alias
     *
     * @return SkillSynonym
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set synonym
     *
     * @param string $synonym
     *
     * @return SkillSynonym
     */
    public function setSynonym($synonym)
    {
        $this->synonym = $synonym;

        return $this;
    }

    /**
     * Get synonym
     *
     * @return string
     */
    public function getSynonym()
    {
        return $this->synonym;
    }
}

