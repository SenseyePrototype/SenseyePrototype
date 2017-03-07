<?php

namespace AppBundle\Controller;

class DebugController extends BaseController
{
    public function dumpAction()
    {
        dump('debug');
        die;
    }
}
