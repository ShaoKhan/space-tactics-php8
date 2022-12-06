<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class IndexController extends AbstractController
{
    
    
    #[Route('/', name: 'index')]
    public function index(TranslatorInterface $trans, Request $request)
    {
        $msg = $trans->trans('index.welcome');
        
        $form = $this->createFormBuilder()
                     ->add('email', TextType::class, [
                         'label'      => 'E-Mail',
                         'label_attr' => [
                             'class' => 'col-1 col-form-label',
                             'for'   => 'email',
                         ],
                         'attr'       => [
                             'class'       => 'form-control',
                             'id'          => 'email',
                             'placeholder' => 'E-Mail',
                         ],
                     ])
                     ->add('password', TextType::class, [
                         'label'      => 'Passwort',
                         'label_attr' => [
                             'class' => 'col-1 col-form-label',
                             'for'   => 'password',
                         ],
                         'attr'       => [
                             'class'       => 'form-control',
                             'id'          => 'password',
                             'placeholder' => 'Passwort',
                         ],
                     ])
                     ->add('submit', SubmitType::class, [
                         'label' => 'Anmelden',
                         'attr'  => [
                             'class' => 'btn btn-primary',
                         ],
                     ])
                     ->getForm();
        
        
        return $this->render('index.html.twig', [
            'msg'  => $msg,
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/news', name: 'news')]
    public function newsIndex()
    {
        return $this->render('news.html.twig');
    }
    
    #[Route('/rules', name: 'rules')]
    public function rulesIndex()
    {
        return $this->render('rules.html.twig');
    }
    
    #[Route('/fights', name: 'fights')]
    public function fightsIndex()
    {
        return $this->render('fights.html.twig');
    }
    
    #[Route('/pillory', name: 'pillory')]
    public function piloryIndex()
    {
        return $this->render('pillory.html.twig');
    }
    
    #[Route('/imprint', name: 'imprint')]
    public function imprintIndex()
    {
        return $this->render('imprint.html.twig');
    }
    
    #[Route('/register', name: 'register')]
    public function registerIndex(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        
        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('register'),
        ]);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $userData = $form->getData();
            /** @var User $userData */
            $userData->setUuid($user->generateUuid());
            $userData->setRegisterOn(new \DateTime());
            #$hashedPassword = $passwordHasher->hashPassword($userData, $userData->getPass());
            $userData->setPass(password_hash($userData->getPass(), PASSWORD_DEFAULT));
            
            $entityManager = $doctrine->getManager();
            $entityManager->persist($userData);
            $entityManager->flush();
            
            $this->addFlash('success', 'User created!');
            
        }
        
        return $this->render('register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
}