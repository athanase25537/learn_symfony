<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/', name: 'app_user')]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $id = $request->query->get('id');
        $user = $userRepository->find(['id' => $id]);
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user
        ]);
    }

    #[Route('/create', name: 'app_user_create')]
    public function create(UserRepository $userRepository, \Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $user = $userRepository->createUser($entityManager, 'Smith', 'Jane', 25, 'jane.smith@example.com');

        if ($user === null) {
            // Handle the error, e.g., throw an exception or redirect elsewhere
            throw $this->createNotFoundException('User could not be created.');
        }

        return $this->redirectToRoute('app_user', ['id' => $user->getId()]);
    }
}
