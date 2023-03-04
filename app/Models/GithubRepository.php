<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GithubRepository extends Model
{
    protected $fillable = [
        'name',
        'description',
        'stars',
        'language',
        'url'
    ];
}
