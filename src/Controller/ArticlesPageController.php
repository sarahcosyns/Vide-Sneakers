<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class ArticlesPageController extends AbstractController
{
    /**
     * @Route("/articles/page/{slug}", name="articles_page")
     */
    public function articles_page($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Article::class);
        $articles = $rep->find($slug);
        $vars = ['unArticle'=>$articles];
        return $this->render('articles_page/articles_page.html.twig', $vars);
    }
}
