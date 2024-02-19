<?php

namespace App\Repositories;

use App\Models\GithubUser;

class EloquentGithubUsersRepository implements IGithubUsersRepository
{
    public function __construct(protected readonly GithubUser $model)
    {
    }

    public function findById(string $id): GithubUser | null
    {
        return $this->model->find($id);
    }

    public function findByName(string $name): GithubUser | null
    {
        return $this->model::where('login', $name)->first();
    }

    public function create(Array $req): GithubUser
    {
        return $this->model->create($req);
    }

    public function update(GithubUser $user, Array $req): void
    {
        $user->update($req);
    }

}
