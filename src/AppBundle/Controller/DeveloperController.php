<?php

namespace AppBundle\Controller;

use AppBundle\Component\Pager\PagerBridge;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DeveloperController extends Controller
{
    public function cityAction(Request $request, $city)
    {
        $cityAlias = strtolower($city);

        $page = max((int)$request->query->get('page'), 1);

        $available = $this->get('senseye.profile.available.criteria.repository')->get();

        $criteria = $this->get('senseye.profile.search.request.analyzer')->analyzeCity($available, $cityAlias);

        if (empty($criteria)) {
            return $this->redirectToRoute('developers.page');
        }

        $profileResponse = $this->get('senseye.profile.searcher')->search($criteria, $page, 17);

        $aggregation = $this->get('senseye.profile.counter')->getAggregation($available, $criteria);

        return $this->render('AppBundle:Developer:list.html.twig', [
            'profiles' => $profileResponse->getResults(),
            'count' => $profileResponse->getPager()->getCount(),
            'pager' => new PagerBridge($profileResponse->getPager()),
            'profileCriteriaContainer' => $this
                ->get('senseye.profile.criteria.container')
                ->merge($available, $criteria, $aggregation),
            'seo' => $this->get('senseye.seo')->getByCityAlias($cityAlias),
        ]);
    }

    public function listAction(Request $request)
    {
        $page = max((int)$request->query->get('page'), 1);

        $available = $this->get('senseye.profile.available.criteria.repository')->get();

        $criteria = $this->get('senseye.profile.search.request.analyzer')->analyze($available, $request);

        $profileResponse = $this->get('senseye.profile.searcher')->search($criteria, $page, 17);

        $aggregation = $this->get('senseye.profile.counter')->getAggregation($available, $criteria);

        return $this->render('AppBundle:Developer:list.html.twig', [
            'profiles' => $profileResponse->getResults(),
            'count' => $profileResponse->getPager()->getCount(),
            'pager' => new PagerBridge($profileResponse->getPager()),
            'profileCriteriaContainer' => $this
                ->get('senseye.profile.criteria.container')
                ->merge($available, $criteria, $aggregation),
        ]);
    }

    public function profileAction()
    {
        return $this->render('@App/Developer/Profile/public.html.twig');
    }
}
