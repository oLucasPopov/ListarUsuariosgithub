<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GithubUser extends Model
{
    protected $fillable = [
        'id',
        'followers_count',
        'following_count',
        'avatar_image',
        'email',
        'bio',
        'repositories'
    ];
}
