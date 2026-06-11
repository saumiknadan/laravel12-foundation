<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or find the Super Admin user
        $user = User::firstOrCreate(
            ['email' => 'admin@site.com'], // Unique identifier to check against
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'), // More modern/secure alternative to bcrypt()
            ]
        );

        // Assign the Spatie role to this user
        $user->assignRole('Super Admin');
    }
}