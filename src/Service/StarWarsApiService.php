<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class StarWarsApiService
{
    private $client;
    private $cache;
    private $cacheTtl;

    public function __construct(CacheInterface $cache, int $cacheTtl)
    {
        $this->client = new Client([
            'base_uri' => 'https://swapi.dev/api/',
        ]);
        $this->cache = $cache;
        $this->cacheTtl = $cacheTtl;
    }

    public function getPeople($page = 1, $search = '')
    {
        $cacheKey = sprintf('star_wars_people_page_%d_search_%s', $page, $search);

        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($page, $search) {
            $item->expiresAfter($this->cacheTtl);

            try {
                $response = $this->client->request('GET', 'people/?page=' . $page . '&search=' . $search);

                $data = json_decode($response->getBody()->getContents(), true);
                return $data;

            } catch (RequestException $e) {
                if ($e->hasResponse()) {
                    $statusCode = $e->getResponse()->getStatusCode();

                    // Manejar códigos de error devueltos por la api
                    switch ($statusCode) {
                        case 400:
                            return ['error' => 'Bad Request: The request was malformed.', 'status_code' => $statusCode];
                        case 404:
                            return ['error' => 'Not Found: The requested resource could not be found.', 'status_code' => $statusCode];
                        case 500:
                            return ['error' => 'Internal Server Error: The server encountered an error.', 'status_code' => $statusCode];
                        default:
                            return ['error' => "HTTP Error: $statusCode", 'status_code' => $statusCode];
                    }
                }

                return ['error' => 'Error fetching data from Star Wars API.', 'e' => $e->getMessage(), 'status_code' => '500'];
            }
        });
    }
}
