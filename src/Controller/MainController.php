<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    //intégrer front routes category/obj
    #[Route('/main', name: 'app_main')]

    public function main():Response {
        return $this->render('main.html.twig', [
            'controller_name' => 'MainController', 
        ]);
    }

    #[Route('/category', name: 'app_category')]
    public function category(): Response
    {
        return $this->render('category.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    #[Route('/object', name: 'app_object')]
    public function object(): Response
    {
        return $this->render('object.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

}
