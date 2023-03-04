<?php

namespace App\Http\Controllers;

use App\Models\GithubUser;
use Illuminate\Http\Request;

class GetGithubUserController extends Controller
{
    public function handle(Request $request, $githubUser)
    {
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
    }
}
