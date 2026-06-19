<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreRoleRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->where('guard_name', 'web')],
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
            'name' => self::normalizeName($this->input('name')),
        ]);
    }

    public function after(): array
    {
        return [
            function (Validator $validator): void {
                if ($this->roleExists()) {
                    $validator->errors()->add('name', 'Role already exists');
                }

                if ($this->input('name') === 'super-admin') {
                    $validator->errors()->add('name', 'The super admin role can only be created by the system seeder.');
                }
            },
        ];
    }

    public static function normalizeName(?string $name): string
    {
        return strtolower(trim((string) $name));
    }

    private function roleExists(): bool
    {
        return filled($this->input('name'))
            && \Spatie\Permission\Models\Role::query()
                ->whereRaw('LOWER(name) = ?', [$this->input('name')])
                ->where('guard_name', 'web')
                ->exists();
    }
}
