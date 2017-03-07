<?php

namespace AppBundle\Controller;

class DebugController extends BaseController
{
    public function dumpAction()
    {
        $user = $this->getUser();
        foreach ($user->getSocialProfiles() as $socialProfile) {

        }
        dump($user);
        die;
    }
}
