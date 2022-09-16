<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{

    public function __construct(
        private CategoryRepository $categoryRepo,
        private ManagerRegistry $doctrine
        ) {
    }

    public function index(Request $request): Response
    {
        $category = new Category();        
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            $form = $this->createForm(CategoryType::class, new Category());

            return $this->redirectToRoute('show_categories');
        }

        $categories = $this->categoryRepo->getAllRecipesCount();

        return $this->render('category/index.html.twig', [
            'categoryForm' => $form->createView(),
            'categories' => $categories
        ]);
    }
}
