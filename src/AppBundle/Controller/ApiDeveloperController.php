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
        $counter = $this->get('senseye.profile.counter')->getCounter($request);

        return new JsonResponse($counter->getData());
    }
}
