<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class EloquentAdminsRepository implements IAdminsRepository
{

    public function __construct(protected readonly User $model)
    {
    }

    public function listAll(): Collection
    {
        return $this->model->all();
    }

    public function findById(string $id): User
    {
        return $this->model->find($id);
    }

    public function create(Array $req): void
    {
        $this->model->create($req);
    }

    public function update(User $user, Array $req): void
    {
        $user->update($req);
    }

    public function delete(User $user): void
    {
        $user->delete();
    }


}
