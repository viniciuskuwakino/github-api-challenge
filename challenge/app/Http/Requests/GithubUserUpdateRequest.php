<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GithubUserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['email', 'nullable', Rule::unique('github_users')->ignore($this['id'])],
            'name' => ['string', 'min:1'],
            'avatar_url' => ['string', 'nullable'],
            'html_url' => ['string', 'nullable'],
            'location' => ['string', 'nullable'],
            'bio' => ['string', 'nullable'],
            'public_repos' => ['integer', 'nullable'],
            'public_gists' => ['integer', 'nullable'],
            'followers' => ['integer', 'nullable'],
            'following' => ['integer', 'nullable'],
        ];
    }
}
