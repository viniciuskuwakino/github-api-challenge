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


}
