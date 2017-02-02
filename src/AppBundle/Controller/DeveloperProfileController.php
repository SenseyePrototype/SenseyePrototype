<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DeveloperProfile;
use AppBundle\Entity\DeveloperProfileSkillLink;
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

        $storeDeveloperProfile = $this
            ->getDoctrine()
            ->getRepository('AppBundle:DeveloperProfile')
            ->findOneBy([
                'user' => $user
            ]);

        $developerProfile = $storeDeveloperProfile ?: new DeveloperProfile();

        $form = $this->createForm('AppBundle\Form\DeveloperProfileType', $developerProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $developerProfile->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($developerProfile);
            $em->flush($developerProfile);
        }

        return $this->render('@App/Developer/Profile/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Lists all developerProfile entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $developerProfiles = $em->getRepository('AppBundle:DeveloperProfile')->findAll();

        return $this->render('developerprofile/index.html.twig', array(
            'developerProfiles' => $developerProfiles,
        ));
    }

    /**
     * Creates a new developerProfile entity.
     *
     */
    public function newAction(Request $request)
    {
        $developerProfile = new DeveloperProfile();
        $form = $this->createForm('AppBundle\Form\DeveloperProfileType', $developerProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $developerProfile->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($developerProfile);

            $skill = $this->getDoctrine()->getRepository('AppBundle:Skill')->find(1);

            $developerProfileSkillLink = new DeveloperProfileSkillLink();
            $developerProfileSkillLink
                ->setDeveloperProfile($developerProfile)
                ->setPosition(1)
                ->setExperience(1)
                ->setSkill($skill)
                ->setScore(8)
            ;

            $em->persist($developerProfileSkillLink);

            $em->flush();

            return $this->redirectToRoute('developer_profile_show', array('id' => $developerProfile->getId()));
        }

        return $this->render('developerprofile/new.html.twig', array(
            'developerProfile' => $developerProfile,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a developerProfile entity.
     *
     */
    public function showAction(DeveloperProfile $developerProfile)
    {
        return $this->render('developerprofile/show.html.twig', array(
            'developerProfile' => $developerProfile,
        ));
    }

    /**
     * Displays a form to edit an existing developerProfile entity.
     *
     */
    public function editByIdAction(Request $request, DeveloperProfile $developerProfile)
    {
        $editForm = $this->createForm('AppBundle\Form\DeveloperProfileType', $developerProfile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('developer_profile_edit', array('id' => $developerProfile->getId()));
        }

        return $this->render('developerprofile/edit.html.twig', array(
            'developerProfile' => $developerProfile,
            'edit_form' => $editForm->createView(),
        ));
    }
}
