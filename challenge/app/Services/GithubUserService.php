<?php

namespace App\Services;

use App\Repositories\IGithubUsersRepository;
use Illuminate\Support\Facades\Auth;

class GithubUserService
{
    public function __construct(private readonly IGithubUsersRepository $githubUsersRepository)
    {
    }

    public function findGithubUserById(string $id): array | null
    {
        $githubUser = $this->githubUsersRepository->findById($id);

        if ($githubUser && $githubUser->adminUsers()->get()->contains(Auth::id())) {
            return $githubUser->toArray();
        }

        return null;
    }

    public function createGithubUser(Array $req): void
    {
        $githubUserExists = $this->githubUsersRepository->findByName($req['login']);

        if ($githubUserExists) {
            $githubUserExists->adminUsers()->attach(Auth::id());
        } else {
            $githubUser = $this->githubUsersRepository->create($req);
            $githubUser->adminUsers()->attach(Auth::id());
        }
    }

    public function updateGithubUser(string $id, Array $req): void
    {
        $githubUser = $this->githubUsersRepository->findById($id);
        $this->githubUsersRepository->update($githubUser, $req);
    }

    public function deleteGithubUser(string $id): void
    {
        $githubUser = $this->githubUsersRepository->findById($id);
        $githubUser->adminUsers()->detach(Auth::id());
    }
}
