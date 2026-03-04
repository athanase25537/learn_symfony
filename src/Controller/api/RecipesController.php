<?php

namespace App\Controller\Api;

use App\Repository\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RecipesController extends AbstractController
{
    #[Route('/api/recipes', name: 'app_api_recipes')]
    public function index(RecipeRepository $recipeRepository)
    {
        $recipes = $recipeRepository->findAll();
        return $recipes;
    }
}
