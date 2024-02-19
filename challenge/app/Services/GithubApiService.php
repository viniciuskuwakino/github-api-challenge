<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class GithubApiService
{
    public function getGithubUser(string $name): array | null
    {

        try {
            $response = Http::timeout(30)->get("https://api.github.com/users/" . $name);

            if ($response->successful()) {
                return json_decode($response->body(), true);
            }
        } catch (Exception $e) {
            echo $e;
        }

        return null;
    }
}
