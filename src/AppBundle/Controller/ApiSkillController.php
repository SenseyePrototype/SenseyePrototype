<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Skill;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ApiSkillController extends Controller
{
    /**
     * @ApiDoc(
     *      description="Skills",
     *      section="skills",
     * )
     * @return JsonResponse
     */
    public function listAction()
    {
        $list = $this->getDoctrine()->getRepository(Skill::class)->getList();

        return new JsonResponse($list);
    }
}
