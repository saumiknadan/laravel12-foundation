<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private const PROTECTED_ROLE = 'super-admin';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        $roles = Role::query()
            ->with(['permissions' => fn ($query) => $query->orderBy('module')->orderBy('action')])
            ->when($search, fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%'))
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.roles.index', compact('roles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissionGroups = $this->permissionGroups();

        return view('admin.roles.create', compact('permissionGroups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            DB::transaction(function () use ($request): void {
                $name = $request->validated('name');

                if ($name === self::PROTECTED_ROLE) {
                    abort(403, 'The super admin role can only be created by the system seeder.');
                }

                if ($this->roleExists($name)) {
                    throw new \InvalidArgumentException('Role already exists');
                }

                $role = Role::create([
                    'name' => $name,
                    'guard_name' => 'web',
                ]);

                $role->syncPermissions($this->selectedPermissions($request->input('permissions', [])));
            });

            return redirect()
                ->route('admin.roles.index')
                ->with('success', 'Role created successfully.');
        } catch (\InvalidArgumentException $exception) {
            return back()
                ->withInput()
                ->withErrors(['name' => $exception->getMessage()]);
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->with('error', 'Role creation failed. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $this->abortIfProtected($role);

        $role->load('permissions');
        $permissionGroups = $this->permissionGroups();
        $assignedPermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.edit', compact('role', 'permissionGroups', 'assignedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->abortIfProtected($role);

        try {
            DB::transaction(function () use ($request, $role): void {
                $name = $request->validated('name');

                if ($this->roleExists($name, $role)) {
                    throw new \InvalidArgumentException('Role already exists');
                }

                $role->update([
                    'name' => $name,
                    'guard_name' => 'web',
                ]);

                $role->syncPermissions($this->selectedPermissions($request->input('permissions', [])));
            });

            return redirect()
                ->route('admin.roles.index')
                ->with('success', 'Role updated successfully.');
        } catch (\InvalidArgumentException $exception) {
            return back()
                ->withInput()
                ->withErrors(['name' => $exception->getMessage()]);
        } catch (Exception $exception) {
            return back()
                ->withInput()
                ->with('error', 'Role update failed. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->abortIfProtected($role);

        try {
            DB::transaction(function () use ($role): void {
                $role->syncPermissions([]);
                $role->delete();
            });

            return redirect()
                ->route('admin.roles.index')
                ->with('success', 'Role deleted successfully.');
        } catch (Exception $exception) {
            return back()->with('error', 'Role delete failed. Please try again.');
        }
    }

    private function permissionGroups()
    {
        return Permission::query()
            ->orderBy('module')
            ->orderBy('action')
            ->get()
            ->groupBy('module');
    }

    private function selectedPermissions(array $permissionIds)
    {
        return Permission::whereIn('id', $permissionIds)->get();
    }

    private function roleExists(string $name, ?Role $ignore = null): bool
    {
        return Role::query()
            ->whereRaw('LOWER(name) = ?', [$name])
            ->where('guard_name', 'web')
            ->when($ignore, fn ($query) => $query->whereKeyNot($ignore->getKey()))
            ->exists();
    }

    private function abortIfProtected(Role $role): void
    {
        abort_if($role->name === self::PROTECTED_ROLE, 403, 'The super admin role cannot be modified.');
    }
}
