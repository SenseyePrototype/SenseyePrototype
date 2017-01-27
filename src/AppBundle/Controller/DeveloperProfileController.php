<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DeveloperProfile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Developerprofile controller.
 *
 */
class DeveloperProfileController extends Controller
{
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
        $developerProfile = new Developerprofile();
        $form = $this->createForm('AppBundle\Form\DeveloperProfileType', $developerProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($developerProfile);
            $em->flush($developerProfile);

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
        $deleteForm = $this->createDeleteForm($developerProfile);

        return $this->render('developerprofile/show.html.twig', array(
            'developerProfile' => $developerProfile,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing developerProfile entity.
     *
     */
    public function editAction(Request $request, DeveloperProfile $developerProfile)
    {
        $deleteForm = $this->createDeleteForm($developerProfile);
        $editForm = $this->createForm('AppBundle\Form\DeveloperProfileType', $developerProfile);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('developer_profile_edit', array('id' => $developerProfile->getId()));
        }

        return $this->render('developerprofile/edit.html.twig', array(
            'developerProfile' => $developerProfile,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a developerProfile entity.
     *
     */
    public function deleteAction(Request $request, DeveloperProfile $developerProfile)
    {
        $form = $this->createDeleteForm($developerProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($developerProfile);
            $em->flush($developerProfile);
        }

        return $this->redirectToRoute('developer_profile_index');
    }

    /**
     * Creates a form to delete a developerProfile entity.
     *
     * @param DeveloperProfile $developerProfile The developerProfile entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DeveloperProfile $developerProfile)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('developer_profile_delete', array('id' => $developerProfile->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
