<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\MailVendeurFormType;
use App\Entity\Article;

class MailVendeurController extends AbstractController {

    /**
     * @Route("/user/mail/vendeur", name="mail_vendeur")
     */
    public function MailVendeur(\Swift_Mailer $mailer, Request $request) {
        $FormulaireMail = $this->createForm(MailVendeurFormType::class, null, ['action' => $this->generateUrl("mail_vendeur"), 'method' => 'POST']);

        $FormulaireMail->handleRequest($request);


        if ($FormulaireMail->isSubmitted() && $FormulaireMail->isValid()) {



            // obtenir le mail du vendeur a partir de l'article
            $em = $this->getDoctrine()->getManager()->getRepository(Article::class);
          
            // on reçoit l'id du template du mail
            $article = $em->find($request->get('idArticle'));
            
            $emailVendeur = $article->getVendeur()->getEmail();
      
            $message = (new \Swift_Message('Vide-Sneakers message de ' . $FormulaireMail->getData()["adresse_mail"]))
                    ->setFrom('developinterface3@gmail.com')
                    ->setTo($emailVendeur)
                    ->setBody("Nom: " . $FormulaireMail->getData()['nom'] . " | Message: " . $FormulaireMail->getData()['message'] . " | Email: " . $FormulaireMail->getData()["adresse_mail"]);

            $mailer->send($message);

            return $this->render('mail_vendeur/envoyer_mail.html.twig');
        } else {
            $vars = ['mailVendeurForm' => $FormulaireMail->createView(),
                'idArticle' => $request->get('idArticle')];
            
            return $this->render('mail_vendeur/contenu_mail.html.twig', $vars);
        }
    }

}
