<?php

namespace App\Controller\Api;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

final class RecipesController extends AbstractController
{
    #[Route('/api/recipes')]
    public function index(RecipeRepository $recipeRepository)
    {
        $recipes = $recipeRepository->findAll();
        return $this->json($recipes, 200, [], [
            "groups" => "recipe.index"
        ]);
    }

    #[Route('/api/recipe/{id}/details')]
    public function details(Recipe $recipe)
    {
        return $this->json($recipe, 200, [], [
            "groups" => "recipe.details"
        ]);
    }
}
