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

        if ($response->status() != 200) {
            switch ($response->status()) {
                case 404:
                    throw new NotFoundHttpException();
                case 403:
                    throw new UnauthorizedHttpException($url, 'Quantidade de requisições excedida, tente novamente mais tarde!');
                default:
                    throw new \Exception('Erro ao realizar requisição: ' . $response->status());
            }
        }

        return $response->json();
    }
}
