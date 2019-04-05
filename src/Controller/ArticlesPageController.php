<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class ArticlesPageController extends AbstractController
{
    /**
     * @Route("/articles/page", name="articles_page")
     */
    public function articles_page()
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Article::class);
        $articles = $rep->findAll();
        $vars = ['unArticle'=>$articles];
        return $this->render('articles_page/articles_page.html.twig');
    }
}
