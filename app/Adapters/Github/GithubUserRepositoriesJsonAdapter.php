<?php

namespace App\Adapters\Github;

use App\Models\GithubUserRepository;
use Illuminate\Support\Facades\URL;

class GithubUserRepositoriesJsonAdapter
{
  static function adapt($json): array
  {
    $result = [];
    foreach ($json as $repository) {
      $user = $repository['owner']['login'];
      $repositoryName = $repository['name']; 
      array_push($result, new GithubUserRepository([
        'name' => $repositoryName, 
        'stars' => $repository['stargazers_count'], 
        'url' => URL::to("api/getGithubUserRepository/$user/$repositoryName"),
        'github_url' => $repository['html_url']
      ]));
    }

    return $result;
  }
}
