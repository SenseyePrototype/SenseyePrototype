<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiDeveloperController extends Controller
{
    public function countAction(Request $request)
    {
        $available = $this->get('senseye.profile.available.criteria.repository')->get();

        $criteria = $this->get('senseye.profile.search.request.analyzer')->analyze($available, $request);

        return new JsonResponse([
            'count' => $this->get('senseye.profile.searcher')->count($criteria),
        ]);
    }
}
