<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserCreateType;
use App\Repository\UserRepository;
use App\Controller\MailerController;
use App\Form\ChangePasswordFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class UserController extends AbstractController
{
    /**
     * @Route("/create-account", name="user_account_create")
     */
    public function createAccount(Request $request, UserPasswordEncoderInterface $passwordEncoder, MailerController $mailerController, MailerInterface $mailerInterface)
    {
        $user = new User();

        $form = $this->createForm(UserCreateType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setToken(md5(uniqid()));
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();

            // Send email to user for activate account
            $mailerController->sendEmail(
                $mailerInterface,
                $user->getEmail(),
                'Merci de vous inscrire!',
                'security/activation.html.twig',
                $user->getName(),
                $user->getToken()
            );

            $this->addFlash("success", "Votre compte a bien été créé ! Merci de verifier vos mails.");
            return $this->redirectToRoute('app_login');
        }
        return $this->render(
            'user/create-account.html.twig',
            [
                "form" => $form->createView()
            ]
        );
    }

    /**
     * @Route("activation/{token}", name="activation", methods={"GET"})
     */
    public function activation($token, UserRepository $userRepository)
    {
        $user = $userRepository->findOneBy(['token' => $token]);

        if (!$user) {
            throw new CustomUserMessageAuthenticationException('Cet utilisateur n\'existe pas.');
        }

        $user->setToken(null);
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/change-password", name="user_password_change")
     * @IsGranted("ROLE_USER")
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(ChangePasswordFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('newPassword')->getData();
            $encodedPassword = $passwordEncoder->encodePassword($user, $plainPassword);
            $user->setPassword($encodedPassword);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Le mot de passe à bien été modifié");
            return $this->redirectToRoute("home");
        }
        return $this->render(
            'security/change-password.html.twig',
            [
                "form" => $form->createView()
            ]
        );
    }
}
