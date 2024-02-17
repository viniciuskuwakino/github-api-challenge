<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface IAdminsRepository
{
    public function listAll(): Collection;

}
