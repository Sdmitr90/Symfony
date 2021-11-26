<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'product')]
    public function index(Request $request): Response
    {
        $manager = $this->getDoctrine()->getManager();
        $category = new Category();
        if ($category->setSlug('Electronics')) {
            $category->setTitle('Electronics');
            $manager->persist($category);
        }

        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setCategoryId(1);
            $product->setPrice(10);
            $product->setQuantity(100);
            $product->setStatus(1);
            $product->setTitle('SomeTitle ' . $i);
            $manager->persist($product);
        }
        $manager->flush();
    }
}