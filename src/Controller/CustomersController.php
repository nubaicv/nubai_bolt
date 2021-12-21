<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Bolt\Controller\TwigAwareController;
use App\Entity\Customers;
use App\Form\CustomerType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CustomersController extends TwigAwareController
{
    #[Route('/{_locale}/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $password_hasher): Response
    {
        
        // Logica para el registro de los customers
        $customer = new Customers();
        
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            
            $customer->setPassword($password_hasher->hashPassword($customer, $form['password']->getData()));
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();
            
            $this->addFlash('success', 'flash.registered');
            
            //$customer = $form->getData();
            
            $route_name = $request->attributes->get('_route');
            return $this->redirectToRoute($route_name);
        }
        
        return $this->renderForm('sign_up.twig', [
            'controller_name' => 'MembersController',
            'form' => $form,
        ]);
    }
    
    #[Route('/{_locale}/login', name: 'login')]
    public function login(): Response
    {
        
        // Logica para el login de los customers
        
        
        return $this->render('sign_in.twig', [
            'controller_name' => 'MembersController',
        ]);
    }
}
