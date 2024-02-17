<?php

namespace App\Providers;

use App\Repositories\EloquentAdminsRepository;
use App\Repositories\IAdminsRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    public array $bindings = [
        IAdminsRepository::class => EloquentAdminsRepository::class
    ];
}
