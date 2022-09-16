<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RecipesController extends BaseController
{

    public function __construct(
        private ManagerRegistry $doctrine,
        private RecipeRepository $recipeRepo,
        private LoggerInterface $logger
        ) {}
    
    public function index(): Response
    {
        $recipes = $this->recipeRepo->listActive();
        return $this->render('recipes/index.html.twig', [
            'recipes' => $recipes
        ]);
    }

    public function store(Request $request): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $thumbnail = $form->get('thumbnail')->getData();
            if($thumbnail) {
                $filename = md5(uniqid()) . '.'. $thumbnail->guessClientExtension();
                $thumbnail->move($this->getParameter('thumbnail_dir'),$filename);
                $recipe->setThumbnail($filename);
            }
            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('recipes'));
        }


        return $this->render('recipes/store.html.twig', [
            'recipeForm' => $form->createView()
        ]);
    }

    public function show(Recipe $recipe): Response {

        return $this->render('recipes/show.html.twig', [
            'recipe' => $recipe
        ]);
    }
}
