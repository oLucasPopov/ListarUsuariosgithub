<?php

namespace Tests\Unit;

use App\Adapters\Github\GithubRepositoryJsonAdapter;
use App\Models\GithubRepository;
use PHPUnit\Framework\TestCase;

class GithubRepositoryJsonAdapterTest extends TestCase
{
    function test_adapt_should_return_a_github_repository_with_correct_values(): void
    {
        $json = [
            'name' => 'test',
            'description' => 'test',
            'stargazers_count' => 1,
            'language' => 'test',
            'html_url' => 'test'
        ];

        $expectedGithubRepository = new GithubRepository([
            'name' => 'test',
            'description' => 'test',
            'stars' => 1,
            'language' => 'test',
            'github_url' => 'test'
        ]);

        $returnedGithubRepository = GithubRepositoryJsonAdapter::adapt($json); 

        $this->assertEquals($expectedGithubRepository, $returnedGithubRepository);
    }
}
