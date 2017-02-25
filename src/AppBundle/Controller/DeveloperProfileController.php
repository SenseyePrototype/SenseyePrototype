<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DeveloperProfile;
use AppBundle\Entity\DeveloperProfileSkillLink;
use AppBundle\Entity\Skill;
use Symfony\Component\HttpFoundation\Request;

/**
 * DeveloperProfile controller.
 *
 */
class DeveloperProfileController extends BaseController
{
    public function editAction(Request $request)
    {
        $user = $this->getUser();

        if (empty($user)) {
            return $this->redirectToRoute('developers.page');
        }

        $developerProfile = $this
            ->getDoctrine()
            ->getRepository(DeveloperProfile::class)
            ->findOneBy([
                'user' => $user
            ]);

        $now = new \DateTime();

        if (empty($developerProfile)) {
            $developerProfile = new DeveloperProfile();
            $developerProfile
                ->setUser($this->getUser())
                ->setCreated($now)
                ->setPublished(true);
        }

        $form = $this->createForm('AppBundle\Form\DeveloperProfileType', $developerProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $developerProfile->setUpdated($now);
            $em = $this->getDoctrine()->getManager();
            $em->persist($developerProfile);
            $em->flush($developerProfile);
            $this->get('senseye.developer.profile.storage')->store($developerProfile);
        }

        return $this->render('@App/Developer/Profile/edit.html.twig', [
            'form' => $form->createView(),
            'exists' => (bool)$developerProfile->getId(),
        ]);
    }

    public function skillsAction()
    {
        $user = $this->getUser();

        if (empty($user)) {
            return $this->redirectToRoute('developers.page');
        }

        $developerProfile = $this
            ->getDoctrine()
            ->getRepository(DeveloperProfile::class)
            ->findOneBy([
                'user' => $user
            ]);

        if (empty($developerProfile)) {
            return $this->redirectToRoute('developer.profile');
        }

        $skills = $this
            ->getDoctrine()
            ->getRepository(Skill::class)
            ->getList();

        $names = array_column($skills, 'alias', 'name');

        return $this->render('@App/Developer/Profile/skills.html.twig', [
            'profile' => $developerProfile,
            'skills' => $names,
        ]);
    }
}
