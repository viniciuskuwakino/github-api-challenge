<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface IAdminsRepository
{
    public function listAll(): Collection;
    public function create(Array $req): void;
    public function findById(string $id): User;
    public function update(User $user, Array $req): void;
    public function delete(User $user): void;

}
