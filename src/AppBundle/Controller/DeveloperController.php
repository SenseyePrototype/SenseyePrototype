<?php

namespace AppBundle\Controller;

use AppBundle\Component\ProfileAvailableCriteriaContainer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DeveloperController extends Controller
{
    public function listAction(Request $request)
    {
        $profileResponse = $this->get('senseye.profile.getter')->search($request);

        return $this->render('AppBundle:Developer:list.html.twig', [
            'profiles' => $profileResponse->getResults(),
            'pager' => $profileResponse->getPager(),
            'profileCriteriaContainer' => new ProfileAvailableCriteriaContainer(
                $this->get('senseye.profile.available.criteria.repository')->get()
            ),
        ]);
    }
}
