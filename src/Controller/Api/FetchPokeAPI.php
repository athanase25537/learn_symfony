<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class FetchPokeAPI extends AbstractController
{
    #[Route('/api/pokemon/ability/{pokemon_id}')]
    public function get_user(HttpClientInterface $client, int $pokemon_id)
    {
        $data = $client->request('GET', "https://pokeapi.co/api/v2/ability/".$pokemon_id);
        $data = $data->toArray();
        return $this->json($data, 200, []);
    }
}
