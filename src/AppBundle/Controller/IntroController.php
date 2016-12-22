<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IntroController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Intro:index.html.twig');
    }
}
