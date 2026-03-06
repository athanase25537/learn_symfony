<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class FetchDolibarrAPI extends AbstractController
{
    #[Route('/api/dolibarr/users/')]
    public function get_users(HttpClientInterface $client)
    {
        $response = $client->request('GET', 'http://localhost:8088/api/index.php/users', [
            'query' => [
                'sortfield' => 't.rowid',
                'sortorder' => 'ASC',
                'limit' => 100,
            ],
            'headers' => [
                'Accept' => 'application/json',
                'DOLAPIKEY' => 'Q7l1T0nM0OghdoYh1GaYv1XSpS24eT43',
            ],
        ]);

        $data = $response->toArray(false);
        $users = [];
        foreach($data as $user) {
            $users[] = [
                'id' => $user["id"],
                'name' => $user['name'],
                'lastname' => $user['lastname'],
                'firstname' => $user['firstname'],
                'email' => $user['email'],
            ];
        }

        return $this->json($users, $response->getStatusCode(), []);
        // return $this->json($data, $response->getStatusCode(), []);
    }
}
