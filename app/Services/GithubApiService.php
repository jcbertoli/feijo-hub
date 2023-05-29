<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;

class GithubApiService {

    public static function getReposFromUser(string $username)
    {
        $uri = sprintf('https://api.github.com/users/%s/repos', $username);

        $response = Http::get($uri);

        return $response->json() ?? [];
    }

}