<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GithubUserRepository extends Model
{
    protected $fillable = [
        'name', 'stars', 'url'
    ];
}
