<?php

namespace App\Controller\Api;

use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

final class RecipesController extends AbstractController
{
    #[Route('/api/recipes')]
    public function index(RecipeRepository $recipeRepository)
    {
        $recipes = $recipeRepository->paginateRecipe(3, 0);
        return $this->json($recipes, 200, [], [
            "groups" => "recipe.index"
        ]);
    }

    #[Route('/api/recipe/{id}/details', requirements: [ "id" => Requirement::DIGITS])]
    public function details(?Recipe $recipe)
    {
        if($recipe) {
            return $this->json($recipe, 200, [], [
                    "groups" => "recipe.details"
                ]);
        }

        $data = [
            "status" => 404,
            "details" => "Not found"
        ];

        return $this->json($data);
        
    }
}
