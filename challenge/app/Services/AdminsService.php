<?php

namespace App\Services;

use App\Repositories\IAdminsRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class AdminsService
{
    public function __construct(private readonly IAdminsRepository $adminsRepository)
    {
    }

    public function listAllAdmins(): Collection
    {
        return $this->adminsRepository->listAll()->except(Auth::id());
    }
}
