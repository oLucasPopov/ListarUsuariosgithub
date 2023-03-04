<?php

namespace App\Http\Controllers;

use App\Models\GithubUser;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GetGithubUserController extends Controller
{
    public function handle(Request $request, $githubUser)
    {
        try {
            $requestGithubUserController = new RequestGithubUserController();
            $githubUserResponse = $requestGithubUserController->handle($githubUser);

            $githubUser = new GithubUser([
                'id' => $githubUserResponse['id'],
                'followers_count' => $githubUserResponse['followers'],
                'following_count' => $githubUserResponse['following'],
                'avatar_image' => $githubUserResponse['avatar_url'],
                'email' => $githubUserResponse['email'],
                'bio' => $githubUserResponse['bio']
            ]);

            return response()->json($githubUser, 200, array(), JSON_UNESCAPED_SLASHES);
        } catch (HttpException $e) {
            $message = $e->getMessage();
            switch ($e->getStatusCode()) {
                case 404:
                    $message = 'Usuário não encontrado!';
                    break;
            }
            return response()->json(['message' => $message], $e->getStatusCode(), array(), JSON_UNESCAPED_SLASHES);
        } catch (Exception $e) {
            return response()->json(['message'=>'Ocorreu um erro interno: ' . $e->getMessage()], 500);
        }
    }
}
