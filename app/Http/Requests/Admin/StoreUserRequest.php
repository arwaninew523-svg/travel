<?php

namespace App\Http\Requests\Admin;

use App\Concerns\PasswordValidationRules;
use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\In;

class StoreUserRequest extends FormRequest
{
    use PasswordValidationRules;

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
     * @return array<string, array<int, In|Rule|string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
            'password' => $this->passwordRules(),
            'role' => ['required', Rule::enum(UserRole::class)],
            'can_view' => ['boolean'],
            'can_create' => ['boolean'],
            'can_edit' => ['boolean'],
            'can_delete' => ['boolean'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'can_view' => $this->boolean('can_view'),
            'can_create' => $this->boolean('can_create'),
            'can_edit' => $this->boolean('can_edit'),
            'can_delete' => $this->boolean('can_delete'),
        ]);
    }

    /**
     * Get the data that is valid for creating a user.
     *
     * @return array<string, mixed>
     */
    public function validUserData(): array
    {
        $role = UserRole::from($this->validated('role'));

        return [
            'name' => $this->validated('name'),
            'email' => $this->validated('email'),
            'password' => $this->validated('password'),
            'role' => $role,
            'can_view' => $role->isFullAccess() || $this->boolean('can_view'),
            'can_create' => $role->isFullAccess() || $this->boolean('can_create'),
            'can_edit' => $role->isFullAccess() || $this->boolean('can_edit'),
            'can_delete' => $role->isFullAccess() || $this->boolean('can_delete'),
        ];
    }
}
