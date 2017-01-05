<?php

namespace AppBundle\Entity;

/**
 * SkillPriority
 */
class SkillPriority
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
     * @var integer
     */
    private $priority;


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
     * @return SkillPriority
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
     * Set priority
     *
     * @param integer $priority
     *
     * @return SkillPriority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }
}

