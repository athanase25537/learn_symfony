<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class FetchAPIData extends AbstractController
{
    #[Route('/api/get-users/{user_id}')]
    public function get_user(HttpClientInterface $client, int $user_id)
    {
        $data = $client->request('GET', "https://budget-management-backend-jwjl.onrender.com/user/get-user-by-id?user_id=".$user_id);
        $data = $data->toArray();
        return $this->json($data["user"], 200, []);
    }
}
