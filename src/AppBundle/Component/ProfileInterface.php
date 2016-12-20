<?php

namespace AppBundle\Component;

interface ProfileInterface
{
    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getDescription();

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
     * @return \DateTimeInterface
     */
    public function getCreated();
}
