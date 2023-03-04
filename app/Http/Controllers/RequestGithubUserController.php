<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class RequestGithubUserController extends Controller
{
    public function handle($user){
        $response = Http::get("https://api.github.com/users/$user");
        return $response->json();
    }
}
