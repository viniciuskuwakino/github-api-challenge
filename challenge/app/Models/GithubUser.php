<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class GithubUser extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'login',
        'email',
        'name',
        'avatar_url',
        'html_url',
        'location',
        'bio',
        'public_repos',
        'public_gists',
        'followers',
        'following',
    ];


    public function adminUsers(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\User');
    }
}
