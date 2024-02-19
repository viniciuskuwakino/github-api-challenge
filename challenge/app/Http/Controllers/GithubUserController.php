<?php

namespace App\Http\Controllers;

use App\Http\Requests\GithubUserStoreRequest;
use App\Http\Requests\GithubUserUpdateRequest;
use App\Services\GithubApiService;
use App\Services\GithubUserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class GithubUserController extends Controller
{
    public function __construct(
        private readonly GithubUserService $githubUserService,
        private readonly GithubApiService $githubApiService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $githubUsers = Auth::user()->githubUsers()->get();

        return Inertia::render('GithubUsers/Show', compact('githubUsers'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GithubUserStoreRequest $request): void
    {
        $githubUser = $this->githubApiService->getGithubUser($request['name']);

        if ($githubUser) {
            $this->githubUserService->createGithubUser($githubUser);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response | RedirectResponse
    {
        $githubUser = $this->githubUserService->findGithubUserById($id);

        if ($githubUser) {
            return Inertia::render('GithubUsers/Details', compact('githubUser'));
        }

        return Redirect::route('github.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $githubUser = $this->githubUserService->findGithubUserById($id);

        return Inertia::render('GithubUsers/Edit', compact('githubUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GithubUserUpdateRequest $request): RedirectResponse
    {
        $this->githubUserService->updateGithubUser($request['id'], $request->except(['id']));

        return Redirect::route('edit.github.user', ['id' => $request['id']]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->githubUserService->deleteGithubUser($id);

        return Redirect::route('github.index');
    }
}
