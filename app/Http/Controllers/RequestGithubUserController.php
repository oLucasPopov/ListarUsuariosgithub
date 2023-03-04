<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RequestGithubUserController extends Controller
{
    public function handle($user)
    {
        $response = Http::get("https://api.github.com/users/$user");

        if ($response->status() == 404 ) {
            throw new NotFoundHttpException();
        }

        return $response->json();
    }
}
