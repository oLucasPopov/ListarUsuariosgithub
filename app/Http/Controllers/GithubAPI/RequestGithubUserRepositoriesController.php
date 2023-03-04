<?php

namespace App\Http\Controllers\GithubAPI;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class RequestGithubUserRepositoriesController extends Controller
{
    public function handle($githubUser) {
        $url = "https://api.github.com/users/$githubUser/repos";
        $response = Http::get($url);
        return $response->json();
    }
}
