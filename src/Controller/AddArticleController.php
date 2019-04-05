<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Photo;
use App\Form\AddArticleFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddArticleController extends AbstractController
{
    /**
     * @Route("/add/article", name="add_article")
     */
    public function addArticle(Request $request)
    {
        
        
        $article = new Article();
        $formAddArticle = $this->createForm(AddArticleFormType::class, $article);
        $formAddArticle->handleRequest($request);

        if ($formAddArticle->isSubmitted() && $formAddArticle->isValid()) {
            
            // article pret sauf dateMiseEnLigne, on l'affecte ici
            $article->setDateMiseEnLigne (new \DateTime());
            
            // affecter l'User. l'User vendeur vient de la session

            // pour le vendeur, on prend l'user du systeme de securite (session)
            $article->setVendeur($this->getUser());
            
            // pour l'acheteur (ailleurs dans le code) l'user est deja dans la bd
//            $rep = $this->getDoctrine()->getManager()->getRepository(User::class);
//            $acheteur = $rep->findOneBy(['email'=> 'sarahcosyns1@gmail.com']);
//            $article->setAcheteur($acheteur);
//                       
            
            //dump ($article);
            //dump ($formAddArticle->getData());
            
            //dump ($request);
            //dump ($request->request->get( "add_article_form"));
            
            // dump ($request->files->get( "add_article_form")['photo']); // contient toutes les photos
            // dump ($request->files->get( "add_article_form")['photo'][0]);
            
            $fichier = $request->files->get( "add_article_form")['photo'][0];
                   
              
            
            $nomFichierServeur = md5(uniqid()).".".$fichier->guessExtension();
            $fichier->move ("dossierFichiers", $nomFichierServeur);
            // creer la photo
            $photo = new Photo();
            // faire set du setPhoto $nomFichierServeur        
            $photo->setPhoto($nomFichierServeur);
            // rajouter a l'article
            $article->addPhoto($photo);
            
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            
            return $this->render('my_account/my_account.html.twig', [
            'addArticleForm' => $formAddArticle->createView(),
        ]);        
        }
        
        else {
            return $this->render('add_article/add_article.html.twig', [
            'addArticleForm' => $formAddArticle->createView(),
        ]);
        }
    }
}
