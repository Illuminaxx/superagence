<?php

namespace App\Controller;

use App\Repository\PropertyRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;



class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(PropertyRepository $repository): Response
    {
        $properties = $repository->findLatest();
        return $this->render('home/home.html.twig', [
            'properties' => $properties
        ]);
    }
}
