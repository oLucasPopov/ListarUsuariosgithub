<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class getGithubUserRepositoryTest extends TestCase
{
    public function test_getGithubUserRepository_route_should_return_200_if_no_error_is_found(): void
    {
        $response = $this->get('/api/getGithubUserRepository/olucaspopov/choris-game');
        $response->assertStatus(200);
    }
}
