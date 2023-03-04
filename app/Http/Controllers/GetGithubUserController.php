<?php

namespace App\Http\Controllers;

use App\Helpers\ControllerHelper;
use App\Http\Controllers\GithubAPI\RequestGithubUserController;
use App\Http\Controllers\GithubAPI\RequestGithubUserRepositoriesController;
use App\Models\GithubUser;
use App\Models\GithubUserRepository;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GetGithubUserController extends Controller
{
    public function handle(Request $request, $githubUser)
    {
        try 
        {
            $repository_order = $request->query('repository_order') ?? 'desc';

            if (!in_array($repository_order, ['asc', 'desc'])) {
                throw new BadRequestHttpException('repository_order');
            }

            $requestGithubUserController = new RequestGithubUserController();
            $requestGithubUserRepositoriesController = new RequestGithubUserRepositoriesController();

            $userRepositories = [];
            $githubUserResponse = $requestGithubUserController->handle($githubUser);
            $githubUserRepositoriesResponse = $requestGithubUserRepositoriesController->handle($githubUser);

            foreach($githubUserRepositoriesResponse as $repository){
                array_push($userRepositories, new GithubUserRepository([
                    'name' => $repository['name']
                    ,'stars' => $repository['stargazers_count']
                    ,'url' => $repository['html_url']
                ]));
            }

            if ($repository_order == 'desc') {
                usort($userRepositories, function ($a, $b) {
                    return $a['stars'] < $b['stars'];
                });
            } else {
                usort($userRepositories, function ($a, $b) {
                    return $a['stars'] > $b['stars'];
                });
            }

            $githubUser = new GithubUser([
                'id' => $githubUserResponse['id'],
                'followers_count' => $githubUserResponse['followers'],
                'following_count' => $githubUserResponse['following'],
                'avatar_image' => $githubUserResponse['avatar_url'],
                'email' => $githubUserResponse['email'],
                'bio' => $githubUserResponse['bio'],
                'repositories' => $userRepositories
            ]);

            return ControllerHelper::return_response($githubUser);
        } catch (Exception | HttpException $e) {
            return ControllerHelper::return_error($e);
        } 
    }
}
