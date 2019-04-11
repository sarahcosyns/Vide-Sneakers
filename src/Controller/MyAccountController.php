<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Form\AddArticleFormType;
use Symfony\Component\HttpFoundation\Request;

class MyAccountController extends AbstractController
{
    /**
     * @Route("/user/my/account", name="my_account")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Article::class);
        $user = $this->getUser();
        $articles = $user->getArticlesVendu();
        $vars = ['unArticle'=>$articles];
        return $this->render('my_account/my_account.html.twig', $vars);
    }
    
    /**
     * @Route("/user/edit/article/{idArticle}", name="edit_article")
     */
//    public function editArticle(Request $request)
//    {
//        
//       $article = chercher par id
//       $formAddArticle = $this->createForm(AddArticleFormType::class, $article);
//       $formAddArticle->handleRequest($request);
//       
//       setAction
//       setMethod
//            
//    
//            return $this->render('my_account/edit_article.html.twig', [
//            'addArticleForm' => $formAddArticle->createView(),
//            'titre' => 'Mise à jour sneakers'
//        ]);
//
//    }

//    public function enregistrerEditionArticle ( )
//
//       $article = vide
//       $formAddArticle = $this->createForm(AddArticleFormType::class, $article);
//       $formAddArticle->handleRequest($request);
//            
//            
//            //       if ($formAddArticle->isSubmitted() && $formAddArticle->isValid()) {
////
////            $article->setVendeur($this->getUser());
////
////            $fichier = $request->files->get( "add_article_form")['photo'][0];
////
////            $nomFichierServeur = md5(uniqid()).".".$fichier->guessExtension();
////            $fichier->move ("dossierFichiers", $nomFichierServeur);
////            // faire set du setPhoto $nomFichierServeur        
////            $photo->setPhoto($nomFichierServeur);
////            // rajouter a l'article
////            $article->addPhoto($photo);
////            
////            
////            $em = $this->getDoctrine()->getManager();
////            $em->flush();
////            
////            return $this->redirectToRoute('my_account');        
////        }
//
//            
    
    
    
    
}
