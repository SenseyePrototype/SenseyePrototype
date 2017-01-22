<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DeveloperController extends Controller
{
    public function cityAction(Request $request, $city)
    {
        $cityAlias = strtolower($city);

        $available = $this->get('senseye.profile.available.criteria.repository')->get();

        $criteria = $this->get('senseye.profile.search.request.analyzer')->analyzeCity($available, $cityAlias);

        $profileResponse = $this->get('senseye.profile.searcher')->search($criteria, 1, 17);

        $aggregation = $this->get('senseye.profile.counter')->getAggregation($available, $criteria);

        return $this->render('AppBundle:Developer:list.html.twig', [
            'profiles' => $profileResponse->getResults(),
            'pager' => $profileResponse->getPager(),
            'profileCriteriaContainer' => $this
                ->get('senseye.profile.criteria.container')
                ->merge($available, $criteria, $aggregation),
            'title' => $this->get('senseye.seo')->getByCityAlias($cityAlias),
        ]);
    }

    public function listAction(Request $request)
    {
        $available = $this->get('senseye.profile.available.criteria.repository')->get();

        $criteria = $this->get('senseye.profile.search.request.analyzer')->analyze($available, $request);

        $profileResponse = $this->get('senseye.profile.searcher')->search($criteria, 1, 17);

        $aggregation = $this->get('senseye.profile.counter')->getAggregation($available, $criteria);

        return $this->render('AppBundle:Developer:list.html.twig', [
            'profiles' => $profileResponse->getResults(),
            'pager' => $profileResponse->getPager(),
            'profileCriteriaContainer' => $this
                ->get('senseye.profile.criteria.container')
                ->merge($available, $criteria, $aggregation),
        ]);
    }
}
