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
}
