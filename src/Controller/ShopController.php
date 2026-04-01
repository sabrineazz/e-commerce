<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShopController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('shop/index.html.twig');
    }

    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('shop/login.html.twig');
    }

    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        return $this->render('shop/profile.html.twig');
    }
    #[Route('/cart', name: 'app_cart')]
    public function cart(): Response
    {
        return $this->render('shop/cart.html.twig');
    }

}
