<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\TestFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(): Response
    {

        $form = $this->createForm(TestFormType::class, [
            'action' => $this->generateUrl('AddProductForm'),
            'method' => 'GET',
        ]);

        $productRepository = $this->getDoctrine()->getRepository(Product::class)->findAll();

        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'allProducts' => $productRepository,
            'form'=>$form->createView(),
        ]);
    }
}
