<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddArticleController extends AbstractController
{
    /**
     * @Route("/add/article", name="add_article")
     */
    public function index()
    {
        return $this->render('add_article/add_article.html.twig');
    }
}
