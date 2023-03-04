<?php

namespace App\Http\Controllers;

use App\Adapters\Github\GithubRepositoryJsonAdapter;
use App\Helpers\ControllerHelper;
use App\Http\Controllers\GithubAPI\RequestGithubRepositoryController;
use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GetGithubRepositoryController extends Controller
{
    public function handle($user, $repository)
    {
        try {
            $requestGithubRepositoryController = new RequestGithubRepositoryController();
            $githubRepositoryResponse = $requestGithubRepositoryController->handle($user, $repository);
            $githubRepository = GithubRepositoryJsonAdapter::adapt($githubRepositoryResponse);

            return ControllerHelper::return_response($githubRepository);
        } catch (Exception | HttpException $e) {
            return ControllerHelper::return_error($e);
        }
    }
}
