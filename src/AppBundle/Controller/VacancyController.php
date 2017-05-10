<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Vacancy;
use Symfony\Component\HttpFoundation\Request;

class VacancyController extends BaseController
{
    public function newAction()
    {
        $user = $this->getUser();

        if (empty($user)) {
            return $this->redirectToRoute('developers.page');
        }

        $form = $this->createForm('AppBundle\Form\VacancyType', new Vacancy());

        return $this->render('@App/Vacancy/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function createAction(Request $request)
    {
        $user = $this->getUser();

        if (empty($user)) {
            return $this->redirectToRoute('developers.page');
        }

        $now = new \DateTime();

        $vacancy = new Vacancy();
        $vacancy
            ->setCreator($user)
            ->setCreated($now)
            ->setUpdated($now);

        $form = $this->createForm('AppBundle\Form\VacancyType', $vacancy);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $em->persist($vacancy);
        $em->flush();

        return $this->redirectToRoute('vacancy.show', [
            'id' => $vacancy->getId(),
        ]);
    }

    public function showAction($id)
    {
        $vacancy = $this
            ->getDoctrine()
            ->getRepository(Vacancy::class)
            ->find($id);

        return $this->render('@App/Vacancy/show.html.twig', [
            'vacancy' => $vacancy,
        ]);
    }
}
