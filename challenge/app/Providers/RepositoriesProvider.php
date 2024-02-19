<?php

namespace App\Providers;

use App\Repositories\EloquentAdminsRepository;
use App\Repositories\EloquentGithubUsersRepository;
use App\Repositories\IAdminsRepository;
use App\Repositories\IGithubUsersRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    public array $bindings = [
        IAdminsRepository::class => EloquentAdminsRepository::class,
        IGithubUsersRepository::class => EloquentGithubUsersRepository::class
    ];
}
