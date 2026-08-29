<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use RuntimeException;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = config('app.super_admin_email');

        if (empty($email)) {
            throw new RuntimeException(
                'SUPER_ADMIN_EMAIL is not configured in the .env file.'
            );
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new RuntimeException(
                "Super Admin user not found with email: {$email}"
            );
        }

        $role = Role::firstOrCreate(
            [
                'name' => 'super-admin',
                'guard_name' => 'web',
            ]
        );

        $user->assignRole($role);
    }
}
