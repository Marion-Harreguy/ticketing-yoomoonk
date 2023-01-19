<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/", name="homepage_")
*/
class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={ "GET" })
     */
    public function index()
    {
        return $this->render('homepage/index.html.twig');
    }
}
