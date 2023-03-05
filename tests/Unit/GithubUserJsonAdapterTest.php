<?php

namespace Tests\Unit;

use App\Adapters\Github\GithubUserJsonAdapter;
use App\Models\GithubUser;
use PHPUnit\Framework\TestCase;

class GithubUserJsonAdapterTest extends TestCase
{
    function mockGithubUser(): GithubUser
    {
        return new GithubUser([
            'id' => 1,
            'followers_count' =>1,
            'following_count' => 1,
            'avatar_image' => 'avatar_image',
            'email' => 'email',
            'bio' => 'bio'
        ]);
    }

    function test_adapt_should_return_a_github_user_with_correct_values(): void
    {
        $json = [
            'id' => 1,
            'followers' => 1,
            'following' => 1,
            'avatar_url' => 'avatar_image',
            'email' => 'email',
            'bio' => 'bio',
        ];

        $expectedUserRepository = $this->mockGithubUser();

        $returnedGithubUser = GithubUserJsonAdapter::adapt($json);

        $this->assertEquals($expectedUserRepository, $returnedGithubUser);
    }
}
