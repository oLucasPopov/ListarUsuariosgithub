<?php

namespace App\Adapters\Github;

use App\Models\GithubUser;

class GithubUserJsonAdapter {
    static function adapt($json): GithubUser {
      return new GithubUser([
        'id' => $json['id'],
        'followers_count' => $json['followers'],
        'following_count' => $json['following'],
        'avatar_image' => $json['avatar_url'],
        'email' => $json['email'],
        'bio' => $json['bio']
      ]);
    }
}
