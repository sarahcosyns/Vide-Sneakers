<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function HomePage()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Article::class);
        $articles = $rep->findAll();
        $vars = ['unArticle'=>$articles];
        
        return $this->render('home_page/home_page.html.twig', $vars);
    }
    
    /**
     * @Route("/ajax/articles", name="ajax-articles")
     */
    public function AjaxArticles(Request $req)
    {
        $criterias = [];
        
        $criterias['genre'] = $req->get('genre');
        $criterias['taille'] = $req->get('taille');
        $criterias['couleur'] = $req->get('couleur');
        
        dump($criterias);
//        die();
//        $valeurGenre = $req->get('genre');
//        $valeurTaille = $req->get('taille');
//        $valeurcouleur = $req->get('couleur');
        
//        dump($valeurGenre);
       
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Article::class);
        $articles = $rep->findAllByCriteria($criterias);
//        $articles = $rep->findBy(['Genre'=>$valeurGenre,
//                                  'Taille'=>$valeurTaille,
//                                  'Couleur'=>$valeurcouleur]);

       
//        dump($articles);
//        die();
        $partialView = $this->renderView("partial/partial_home_page.html.twig", [
            'unArticle' => $articles
        ]);
        $arrayReponse = ['partialView' => $partialView];
        
     return new JsonResponse($arrayReponse);
    }
}
