<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiDeveloperController extends Controller
{
    public function countAction()
    {
        return new JsonResponse([]);
    }
}
