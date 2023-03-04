<?php

namespace App\Adapters\Github;

use App\Models\GithubRepository;

class GithubRepositoryJsonAdapter {
  static function adapt($json): GithubRepository {
    return new GithubRepository([
      'name' => $json['name'],
      'description' => $json['description'],
      'stars' => $json['stargazers_count'],
      'language' => $json['language'],
      'github_url' => $json['html_url']
    ]);
  }
}
