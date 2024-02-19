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

    public function findAdminById(string $id): array
    {
        return $this->adminsRepository->findById($id)->toArray();
    }

    public function createAdmin(Array $req): void
    {
        $this->adminsRepository->create($req);
    }

    public function updateAdmin(string $id, Array $req): void
    {
        $adminUser = $this->adminsRepository->findById($id);
        $this->adminsRepository->update($adminUser, $req);
    }

    public function deleteAdmin(string $id): void
    {
        $adminUser = $this->adminsRepository->findById($id);
        $this->adminsRepository->delete($adminUser);
    }

}
