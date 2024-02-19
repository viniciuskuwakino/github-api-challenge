<?php

namespace App\Repositories;

use App\Models\GithubUser;

interface IGithubUsersRepository
{
    public function findById(string $id): GithubUser | null;
    public function create(Array $req): GithubUser;
    public function findByName(string $name): GithubUser | null;
    public function update(GithubUser $user, Array $req): void;


}
