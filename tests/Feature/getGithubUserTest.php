<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class getGithubUserTest extends TestCase
{
    public function test_getGithubUser_route_should_return_200_if_no_error_is_found(): void
    {
        $response = $this->get('/api/getGithubUser/olucaspopov');
        $response->assertStatus(200);
    }

    public function test_getGithubUser_route_should_return_404_if_user_is_not_found(): void
    {
        // O usuário admin é proibido pelo Github
        $response = $this->get('/api/getGithubUser/admin');
        $response->assertStatus(404);
    }
}
