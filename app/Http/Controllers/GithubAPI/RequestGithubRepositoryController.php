<?php

namespace App\Http\Controllers\GithubAPI;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class RequestGithubRepositoryController extends Controller
{
    public function handle($user, $repository)
    {
        $url = "https://api.github.com/repos/$user/$repository";
        $response = Http::get($url);

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
