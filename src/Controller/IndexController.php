<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use App\Security\EmailVerifier;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Mime\Address;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class IndexController extends AbstractController
{
    private Session $session;


    public function __construct()
    {
        $this->session = new Session();
    }

    #[Route('/', name: 'index')]
    public function index(TranslatorInterface $trans, Request $request, RequestStack $requestStack)
    {
        $msg = $trans->trans('index.welcome');
        return $this->render('index.html.twig', [
            'msg' => $msg,
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
    public function registerIndex(
        Request                     $request,
        ManagerRegistry             $doctrine,
        UserPasswordHasherInterface $passwordHasher,
        EmailVerifier               $emailVerifier,

    ): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('register'),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userData = $form->getData();

            $email = $doctrine->getRepository(User::class)->findOneBy(['email' => $user->getEmail()]);
            if ($email) {
                $this->session->getFlashBag()->add('error', 'Diese E-Mail-Adresse ist bereits vergeben.');
                return $this->redirectToRoute('register');
            }
            /** @var User $userData */
            $userData->setUuid($user->generateUuid());
            $userData->setRegisterOn(new \DateTime());
            $hashedPassword = $passwordHasher->hashPassword($userData, $userData->getPassword());
            $userData->setPassword($hashedPassword);

            $userData->setRoles(['ROLE_USER']);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($userData);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $emailVerifier->sendEmailConfirmation('verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('account@space-tactics.com', 'Space-Tactics Account'))
                    ->to($userData->getEmail())
                    ->subject('Dein Account wurde erstellt')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            $this->session->getFlashBag()->add('success', 'Dein Account wurde erfolgreich erstellt.');

        }

        return $this->render('register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('register');
        }
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('index');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(Security $security)
    {
        $response = $security->logout(false);
        return $this->redirectToRoute('index' );
    }



}