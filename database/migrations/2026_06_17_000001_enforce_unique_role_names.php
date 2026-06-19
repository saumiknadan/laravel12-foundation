<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('roles')
            ->whereRaw('LOWER(TRIM(name)) IN (?, ?)', ['super admin', 'super-admin'])
            ->update(['name' => 'super-admin']);

        $this->mergeDuplicateRoles();

        DB::table('roles')->update([
            'name' => DB::raw('LOWER(TRIM(name))'),
        ]);

        Schema::table('roles', function (Blueprint $table): void {
            $table->dropUnique('roles_name_guard_name_unique');
            $table->unique('name', 'roles_name_unique');
        });
    }

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table): void {
            $table->dropUnique('roles_name_unique');
            $table->unique(['name', 'guard_name'], 'roles_name_guard_name_unique');
        });
    }

    private function mergeDuplicateRoles(): void
    {
        DB::table('roles')
            ->select('id', 'name', 'guard_name')
            ->orderBy('id')
            ->get()
            ->groupBy(fn ($role) => strtolower(trim($role->name)))
            ->each(function ($roles): void {
                if ($roles->count() < 2) {
                    return;
                }

                $keeper = $roles->first();

                $roles->skip(1)->each(function ($duplicate) use ($keeper): void {
                    DB::table('role_has_permissions')
                        ->where('role_id', $duplicate->id)
                        ->get()
                        ->each(function ($permission) use ($keeper): void {
                            DB::table('role_has_permissions')->updateOrInsert([
                                'permission_id' => $permission->permission_id,
                                'role_id' => $keeper->id,
                            ]);
                        });

                    DB::table('model_has_roles')
                        ->where('role_id', $duplicate->id)
                        ->get()
                        ->each(function ($assignment) use ($keeper): void {
                            DB::table('model_has_roles')->updateOrInsert([
                                'role_id' => $keeper->id,
                                'model_type' => $assignment->model_type,
                                'model_id' => $assignment->model_id,
                            ]);
                        });

                    DB::table('role_has_permissions')->where('role_id', $duplicate->id)->delete();
                    DB::table('model_has_roles')->where('role_id', $duplicate->id)->delete();
                    DB::table('roles')->where('id', $duplicate->id)->delete();
                });
            });
    }
};
