<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EmployerProfile;
use Symfony\Component\HttpFoundation\Request;

class EmployerProfileController extends BaseController
{
    public function editAction(Request $request)
    {
        $user = $this->getUser();

        if (empty($user)) {
            return $this->redirectToRoute('developers.page');
        }

        $employerProfile = $this
            ->getDoctrine()
            ->getRepository(EmployerProfile::class)
            ->findOneBy([
                'user' => $user
            ]);

        $now = new \DateTime();

        if (empty($employerProfile)) {
            $employerProfile = new EmployerProfile();
            $employerProfile
                ->setUser($user)
                ->setCreated($now);
        }

        $form = $this->createForm('AppBundle\Form\EmployerProfileType', $employerProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employerProfile->setUpdated($now);
            $em = $this->getDoctrine()->getManager();
            $em->persist($employerProfile);
            $em->flush($employerProfile);
        }

        return $this->render('@App/Employer/Profile/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
