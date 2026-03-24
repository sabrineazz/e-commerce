<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    #[Route('/product/{id}', name: 'app_product_details')]
    public function productDetails(int $id): Response
    {
        return $this->render('shop/product_details.html.twig');
    }

    #[Route('/categories', name: 'app_browse_categories')]
    public function browseCategories(): Response
    {
        return $this->render('shop/browse_categories.html.twig');
    }

    #[Route('/cart', name: 'app_cart')]
    public function cart(): Response
    {
        return $this->render('shop/cart.html.twig');
    }

    #[Route('/category/{id}/products', name: 'app_products_by_category')]
    public function productsByCategory(int $id): Response
    {
        return $this->render('shop/products_by_category.html.twig');
    }
}
