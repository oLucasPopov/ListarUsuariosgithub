<?php

namespace Tests\Unit;

use App\Adapters\Github\GithubRepositoryJsonAdapter;
use App\Models\GithubRepository;
use PHPUnit\Framework\TestCase;

class GithubRepositoryJsonAdapterTest extends TestCase
{
    private function mockGithubRepository(): GithubRepository
    {
        return new GithubRepository([
            'name' => 'test',
            'description' => 'test',
            'stars' => 1,
            'language' => 'test',
            'github_url' => 'test'
        ]);
    }

    function test_adapt_should_return_a_github_repository_with_correct_values(): void
    {
        $json = [
            'name' => 'test',
            'description' => 'test',
            'stargazers_count' => 1,
            'language' => 'test',
            'html_url' => 'test'
        ];

        $expectedGithubRepository = $this->mockGithubRepository();

        $returnedGithubRepository = GithubRepositoryJsonAdapter::adapt($json);

        $this->assertEquals($expectedGithubRepository, $returnedGithubRepository);
    }

    function test_adapt_should_return_a_github_repository_with_correct_values_when_exceding_fields_are_provided(): void
    {
        $json = [
            'name' => 'test',
            'description' => 'test',
            'stargazers_count' => 1,
            'language' => 'test',
            'html_url' => 'test',
            'exceding_key' => 'exceding_value'
        ];

        $expectedGithubRepository = $this->mockGithubRepository();

        $returnedGithubRepository = GithubRepositoryJsonAdapter::adapt($json);

        $this->assertEquals($expectedGithubRepository, $returnedGithubRepository);
    }
}
