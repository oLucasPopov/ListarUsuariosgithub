<?php

use App\Http\Controllers\GetGithubRepositoryController;
use App\Http\Controllers\GetGithubUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('getGithubUser/{githubUser}', [GetGithubUserController::class, 'handle']);
Route::get('getGithubUserRepository/{githubUser}/{userRepository}', [GetGithubRepositoryController::class, 'handle']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
