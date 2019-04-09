<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
    
}
