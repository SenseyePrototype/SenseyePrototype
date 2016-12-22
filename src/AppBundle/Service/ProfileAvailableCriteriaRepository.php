<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileAvailableCriteria;

class ProfileAvailableCriteriaRepository
{
    public function get()
    {
        return new ProfileAvailableCriteria([], [], []);
    }
}
