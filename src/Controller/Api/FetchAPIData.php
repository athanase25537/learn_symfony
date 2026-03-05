<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class FetchAPIData extends AbstractController
{
    #[Route('/api/get-users')]
    public function get_user(HttpClientInterface $client)
    {
        $data = $client->request('GET', "https://budget-management-backend-jwjl.onrender.com/user/get-user-by-id?user_id=2");
        $data = $data->toArray();
        return $this->json($data["user"], 200, []);
    }
}
