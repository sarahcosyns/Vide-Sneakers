<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MailVendeurController extends AbstractController
{
    /**
     * @Route("/user/mail/vendeur", name="mail_vendeur")
     */
    public function MailVendeur(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message ('Hello Vide-Sneakers'))
                ->setFrom('vide-sneakers@gmail.com')
                ->setTo ('sarahcosyns1@gmail.com')
                ->setBody (
                  $this->renderView (
                          'mail_vendeur/contenu_mail.html.twig'
                          ),
                        'text/html'
                );
        $mailer->send($message);

        return $this->render('mail_vendeur/envoyer_mail.html.twig');
    }
}
