<?php

namespace App\Http\Controllers;

use App\Adapters\Github\GithubUserJsonAdapter;
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
            $repository_order = strtoupper($request->query('repository_order') ?? 'desc');

            if (!in_array($repository_order, ['ASC', 'DESC'])) {
                throw new BadRequestHttpException('repository_order');
            }

            $requestGithubUserController = new RequestGithubUserController();
            $requestGithubUserRepositoriesController = new RequestGithubUserRepositoriesController();

            $userRepositories = [];
            $githubUserResponse = $requestGithubUserController->handle($githubUser);
            $githubUserRepositoriesResponse = $requestGithubUserRepositoriesController->handle($githubUser);
           
            $githubUserModel = GithubUserJsonAdapter::adapt($githubUserResponse);
            $userRepositories = GithubUserRepositoriesJsonAdapter::adapt($githubUserRepositoriesResponse);
            ArrayHelper::sort_array($userRepositories, 'stars', $repository_order);

            $githubUserModel['repositories'] = $userRepositories;

            return ControllerHelper::return_response($githubUserModel);
        } catch (Exception | HttpException $e) {
            return ControllerHelper::return_error($e);
        } 
    }
}
