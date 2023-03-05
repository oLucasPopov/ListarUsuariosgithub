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

    public function test_getGithubUser_route_should_return_200_if_ascending_order_in_lowercase_is_provided(): void
    {
        $response = $this->get('/api/getGithubUser/olucaspopov?repository_order=asc');
        $response->assertStatus(200);
    }

    public function test_getGithubUser_route_should_return_200_if_ascending_order_in_uppercase_is_provided_when_user_exists(): void
    {
        $response = $this->get('/api/getGithubUser/olucaspopov?repository_order=ASC');
        $response->assertStatus(200);
    }    

    public function test_getGithubUser_route_should_return_200_if_descending_order_in_lowercase_is_provided(): void
    {
        $response = $this->get('/api/getGithubUser/olucaspopov?repository_order=desc');
        $response->assertStatus(200);
    }

    public function test_getGithubUser_route_should_return_200_if_descending_order_in_uppercase_is_provided(): void
    {
        $response = $this->get('/api/getGithubUser/olucaspopov?repository_order=DESC');
        $response->assertStatus(200);
    }

    public function test_getGithubUser_route_should_return_404_if_user_is_not_found(): void
    {
        // O usuário admin é proibido pelo Github
        $response = $this->get('/api/getGithubUser/admin');
        $response->assertStatus(404);
    }
}
