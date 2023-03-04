<?php

namespace App\Http\Controllers;

use App\Adapters\Github\GithubUserRepositoriesJsonAdapter;
use App\Helpers\ArrayHelper;
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

            $userRepositories = GithubUserRepositoriesJsonAdapter::adapt($githubUserRepositoriesResponse);

            ArrayHelper::sort_array($userRepositories, 'stars', $repository_order);

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
