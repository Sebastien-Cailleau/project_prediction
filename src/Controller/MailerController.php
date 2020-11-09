<?php

namespace App\Controller;

use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MailerController extends AbstractController
{

  public function sendEmail(MailerInterface $mailer, $userMail, $subject, $html, $username, $token)
  {
    $email = (new TemplatedEmail())
      ->from(new Address('contact@sebastien-cailleau.zd.fr', 'Formula One Predection'))
      ->to($userMail)
      ->subject($subject)
      ->htmlTemplate($html)
      ->context([
        'username' => $username,
        'token' => $token
      ]);

    $mailer->send($email);
  }
}
