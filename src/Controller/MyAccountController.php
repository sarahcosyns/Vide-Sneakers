<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyAccountController extends AbstractController
{
    /**
     * @Route("/my/account", name="my_account")
     */
    public function index()
    {
        return $this->render('my_account/my_account.html.twig', [
            'controller_name' => 'MyAccountController',
        ]);
    }
}
