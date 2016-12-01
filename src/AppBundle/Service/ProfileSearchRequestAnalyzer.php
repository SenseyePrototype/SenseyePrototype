<?php

namespace AppBundle\Service;

use AppBundle\Component\ProfileAvailableCriteria;
use AppBundle\Component\ProfileSearchCriteria;
use AppBundle\Component\Range;
use Symfony\Component\HttpFoundation\Request;

class ProfileSearchRequestAnalyzer
{
    public function analyze(ProfileAvailableCriteria $available, Request $request)
    {
        return new ProfileSearchCriteria([], new Range());
    }
}
