<?php

namespace App\Adapters\Github;

use App\Models\GithubUserRepository;

class GithubUserRepositoriesJsonAdapter
{
  static function adapt($json): array
  {
    $result = [];
    foreach ($json as $repository) {
      array_push($result, new GithubUserRepository([
        'name' => $repository['name'], 'stars' => $repository['stargazers_count'], 'url' => $repository['html_url']
      ]));
    }

    return $result;
  }
}
