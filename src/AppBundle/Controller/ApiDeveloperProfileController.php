<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DeveloperProfile;
use AppBundle\Entity\DeveloperProfileSkillLink;
use AppBundle\Entity\Skill;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ApiDeveloperProfileController extends Controller
{
    /**
     * @ApiDoc(
     *      description="Developer profile add skill",
     *      section="developer-profile",
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function addSkillAction(Request $request)
    {
        $alias = $request->request->get('alias');

        $developerProfile = $this->getProfile();

        $skill = $this->getSkill($alias);

        $now = new \DateTime();

        $manager = $this->getDoctrine()->getManager();

        $link = new DeveloperProfileSkillLink();

        $link
            ->setDeveloperProfile($developerProfile)
            ->setSkill($skill)
            ->setScore(7)
            ->setPosition(1)
            ->setExperience(1)
            ->setCreated($now)
            ->setUpdated($now);

        $manager->persist($link);
        $developerProfile->addSkillLink($link);

        $manager->flush();

        return new JsonResponse([]);
    }

    /**
     * @ApiDoc(
     *      description="Developer profile delete skill",
     *      section="developer-profile",
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteSkillAction(Request $request)
    {
        $alias = $request->request->get('alias');

        $developerProfile = $this->getProfile();

        $skill = $this->getSkill($alias);

        return new JsonResponse([]);
    }

    private function getProfile()
    {
        $user = $this->getUser();

        return $this
            ->getDoctrine()
            ->getRepository(DeveloperProfile::class)
            ->findOneBy([
                'user' => $user
            ]);
    }

    private function getSkill($alias)
    {
        return $this
            ->getDoctrine()
            ->getRepository(Skill::class)
            ->findOneBy([
                'alias' => $alias,
            ]);
    }
}
