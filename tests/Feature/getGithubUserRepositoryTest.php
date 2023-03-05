<?php

namespace Tests\Feature;

use App\Http\Controllers\GetGithubRepositoryController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class getGithubUserRepositoryTest extends TestCase
{
    public function test_getGithubUserRepository_route_should_return_200_if_no_error_is_found(): void
    {
        $response = $this->get('/api/getGithubUserRepository/olucaspopov/choris-game');
        $response->assertStatus(200);
    }

    public function test_getGithubUserRepository_route_should_return_404_if_user_and_repository_combination_is_not_found(): void
    {
        $response = $this->get('/api/getGithubUserRepository/admin/choris-game');
        $response->assertStatus(404);
    }

    public function test_getGithubUserRepository_route_should_return_500_if_an_unexpected_error_occurs(): void
    {
        $mockHttpClient = Mockery::mock(GetGithubRepositoryController::class);
        $mockHttpClient->shouldReceive('handle')
            ->andThrow(new \Exception('Unexpected error'));

        $this->app->instance(GetGithubRepositoryController::class, $mockHttpClient);

        $response = $this->get('/api/getGithubUserRepository/admin/choris-game');

        $response->assertStatus(500);
    }
}
