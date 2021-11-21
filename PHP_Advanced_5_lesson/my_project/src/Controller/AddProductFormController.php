<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\TestFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddProductFormController extends AbstractController
{
    #[Route('/AddProductForm', name: 'AddProductForm')]
    public function index(Request $request): Response
    {
        $product = new Product();

        $form = $this->createForm(TestFormType::class, $product, [
            'action' => $this->generateUrl('AddProductForm'),
            'method' => 'GET',
        ]);


        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $product = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
        }
        return $this->redirectToRoute('home_page');
    }

}
