<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

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
}
