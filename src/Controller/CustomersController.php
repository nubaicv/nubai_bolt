<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Bolt\Controller\TwigAwareController;

class CustomersController extends TwigAwareController
{
    #[Route('/register', name: 'register')]
    public function register(): Response
    {
        
        // Logica para el registro de los customers
        
        
        return $this->render('sign_up.twig', [
            'controller_name' => 'MembersController',
        ]);
    }
    
    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        
        // Logica para el login de los customers
        
        
        return $this->render('sign_in.twig', [
            'controller_name' => 'MembersController',
        ]);
    }
}
