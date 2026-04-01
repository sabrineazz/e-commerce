<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/catalogue', name: 'product')]
final class ProductController extends AbstractController
{
    #[Route('/', name: 'browse_categories')]
    public function browseCategories(CategoryRepository $repo): Response
    {
        return $this->render('product/browse_categories.html.twig', [
            'categories' => $repo->findAll(),
        ]);
    }

    #[Route('/categorie/{slug}', name: 'products_by_category')]
    public function byCategory(string $slug, CategoryRepository $repo): Response
    {
        $category = $repo->findOneBy(['slug' => $slug]);
        if (!$category) {
            throw $this->createNotFoundException('Catégorie introuvable');
        }
        return $this->render('product/products_by_category.html.twig', [
            'category' => $category,
            'products' => $category->getProducts(),
        ]);
    }

    #[Route('/produit/{slug}', name: 'product_details')]
    public function details(string $slug, ProductRepository $repo): Response
    {
        $product = $repo->findOneBy(['slug' => $slug]);
        if (!$product) {
            throw $this->createNotFoundException('Produit introuvable');
        }
        return $this->render('product/product_details.html.twig', [
            'product' => $product,
        ]);
    }
}
