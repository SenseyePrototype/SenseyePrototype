<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DeveloperProfile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IntroController extends Controller
{
    public function indexAction()
    {
        $developerProfile = new DeveloperProfile();

        $developerProfile
            ->setUser($this->getUser())
            ->setTitle('Backend developer')
            ->setSalary(5000)
            ->setExperience(7)
        ;

        $this->getDoctrine()->getManager()->persist($developerProfile);
        $this->getDoctrine()->getManager()->flush($developerProfile);

        return $this->render('AppBundle:Intro:index.html.twig');
    }
}
