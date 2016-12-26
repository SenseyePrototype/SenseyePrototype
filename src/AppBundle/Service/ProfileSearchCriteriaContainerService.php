<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileAvailableCriteria;
use AppBundle\Component\ProfileAvailableCriteriaContainer;
use AppBundle\Component\ProfileSearchCriteria;

class ProfileSearchCriteriaContainerService
{
    public function merge(ProfileAvailableCriteria $availableCriteria, ProfileSearchCriteria $searchCriteria)
    {
        return new ProfileAvailableCriteriaContainer(
            $availableCriteria,
            $searchCriteria
        );
    }
}
