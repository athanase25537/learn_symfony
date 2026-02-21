<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{

    #[Route('/', name: 'app_users')]
    public function main(UserRepository $userRepository): Response 
    {
        $users = $userRepository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/new-user', name: 'app_new_user')]
    public function newUser(EntityManagerInterface $em, Request $request): Response 
    {
        $userForm = $this->createForm(UserType::class);
        $userForm->handleRequest($request);
        if($userForm->isSubmitted() && $userForm->isValid()) {
            $user = $userForm->getData();
            $em->persist($user);
            $em->flush();
            $this->addFlash("success", "This is my message");
            return $this->redirectToRoute('app_users');
        }

        return $this->render('user/new_user.html.twig', [
            'user_form' => $userForm
        ]);
    }

    #[Route('/', name: 'app_user')]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $id = $request->query->get('id');
        $user = $userRepository->find(['id' => $id]) ? $id : null;
        return $this->render('user/index.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/create', name: 'app_user_create')]
    public function create(UserRepository $userRepository, \Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $userForm = $this->createForm(UserType::class);

        return $this->redirectToRoute('app_new_user', ['user_form' => $userForm]);
    }

    #[Route('/user/edit/{id}', name: 'app_user_edit')]
    public function edit(User $user, Request $request, EntityManagerInterface $em)
    {
        $userForm = $this->createForm(UserType::class, $user);
        $userForm->handleRequest($request);
        if($userForm->isSubmitted() && $userForm->isValid()) {
            $em->flush();
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'user_form' => $userForm
        ]);
    }
}
