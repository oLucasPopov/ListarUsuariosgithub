<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class RequestGithubUserController extends Controller
{
    public function handle($user)
    {
        $url = "https://api.github.com/users/$user";
        $response = Http::get("https://api.github.com/users/$user");

        if ($response->status() == 404) {
            throw new NotFoundHttpException();
        }

        if ($response->status() == 403) {
            throw new UnauthorizedHttpException(
                $url,
                'Quantidade de requisições excedida, tente novamente mais tarde!'
            );
        }

        return $response->json();
    }
}
