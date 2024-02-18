<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Services\AdminsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class AdminUserController extends Controller
{
    public function __construct(private readonly AdminsService $adminsService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $users = $this->adminsService->listAllAdmins();

        return Inertia::render('Admin/Show', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreRequest $request): RedirectResponse
    {
        $this->adminsService->createAdmin($request->all());
        $users = $this->adminsService->listAllAdmins();

        return to_route('admin.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $selectedAdminUser = $this->adminsService->findAdminById($id);

        return Inertia::render('Admin/Edit', compact('selectedAdminUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $request): RedirectResponse
    {
        $this->adminsService->updateAdmin($request['id'], $request->except(['id']));
        return Redirect::route('edit.admin.user', ['id' => $request['id']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->adminsService->deleteAdmin($id);

        return Redirect::route('admin.show');
    }
}
