<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DeveloperController extends Controller
{
    public function listAction()
    {
        return $this->render('AppBundle:Developer:list.html.twig', [
            // ...
        ]);
    }
}
