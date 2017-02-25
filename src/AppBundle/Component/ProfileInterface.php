<?php

namespace AppBundle\Component;

interface ProfileInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return string
     */
    public function getLink();

    /**
     * @return array
     */
    public function getSkills();

    /**
     * @return array
     */
    public function getCities();

    /**
     * @return int
     */
    public function getSalary();

    /**
     * @return float|int
     */
    public function getExperience();

    /**
     * @return string
     */
    public function getAssert();

    /**
     * @return string
     */
    public function getExpect();

    /**
     * @return \DateTimeInterface
     */
    public function getCreated();

    /**
     * @return bool
     */
    public function isInternal();
}
