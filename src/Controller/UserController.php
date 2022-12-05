<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Validator\Constraints\FormValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    #[Route('/user-register', name: 'user_register')]
    public function register(Request $request, ValidatorInterface $validator): Response
    {
        $user = new User();
        $errors = $validator->validate($user);
        
        if($errors->count() > 0) {
            return $this->render('user/register.html.twig', [
                'errors' => $errors,
            ]);
        }
        
        
        return $this->render('user/register.html.twig');
    }
    
    
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
