<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ApiDeveloperController extends Controller
{
    /**
     * @ApiDoc(
     *      description="Developers count by criteria",
     *      section="developer-search",
     *      parameters={
     *          {"name": "skills", "dataType": "string", "required": false, "description": "aliases separated my comma"},
     *          {"name": "cities", "dataType": "string", "required": false, "description": "aliases separated my comma"},
     *          {"name": "experience", "dataType": "string", "required": false, "description": "range from-to"},
     *          {"name": "salary", "dataType": "string", "required": false, "description": "range from-to"},
     *      }
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function countAction(Request $request)
    {
        $available = $this->get('senseye.profile.available.criteria.repository')->get();

        $criteria = $this->get('senseye.profile.search.request.analyzer')->analyze($available, $request);

        $counter = $this->get('senseye.profile.counter')->getCounter($available, $criteria);

        return new JsonResponse($counter->getData());
    }
}
