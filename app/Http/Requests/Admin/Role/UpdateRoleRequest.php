<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Spatie\Permission\Models\Role;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $role = $this->route('role');

        return ! $role instanceof Role || $role->name !== 'super-admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $role = $this->route('role');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')
                    ->where('guard_name', 'web')
                    ->ignore($role?->id),
            ],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', Rule::exists('permissions', 'id')->where('guard_name', 'web')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Role already exists',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => StoreRoleRequest::normalizeName($this->input('name')),
        ]);
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                if ($this->roleExists()) {
                    $validator->errors()->add('name', 'Role already exists');
                }
            },
        ];
    }

    private function roleExists(): bool
    {
        $role = $this->route('role');

        return filled($this->input('name'))
            && Role::query()
                ->whereRaw('LOWER(name) = ?', [$this->input('name')])
                ->where('guard_name', 'web')
                ->when($role instanceof Role, fn ($query) => $query->whereKeyNot($role->getKey()))
                ->exists();
    }
}
