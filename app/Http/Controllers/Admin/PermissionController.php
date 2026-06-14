<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        $permissions = Permission::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('module', 'like', '%' . $search . '%')
                        ->orWhere('action', 'like', '%' . $search . '%')
                        ->orWhere('name', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('module')
            ->orderBy('action')
            ->get()
            ->groupBy('module');

        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $modules = $permissions->forPage($page, $perPage);
        $permissions = new LengthAwarePaginator(
            $modules,
            $permissions->count(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return view('admin.permissions.index', compact('permissions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'module' => ['required', 'string', 'max:255'],
            'actions' => ['required', 'array', 'min:1'],
            'actions.*' => ['required', 'string', 'max:255', 'distinct:ignore_case'],
        ]);

        DB::beginTransaction();

        try {
            $module = Str::lower(trim($request->module));
            $actions = collect($request->actions)
                ->map(fn ($action) => Str::lower(trim($action)))
                ->filter()
                ->unique()
                ->values();

            if ($module === '') {
                throw ValidationException::withMessages([
                    'module' => 'Please enter a valid module name.',
                ]);
            }

            if ($actions->isEmpty()) {
                throw ValidationException::withMessages([
                    'actions' => 'Please add at least one permission action.',
                ]);
            }

            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => $module . '.' . $action,
                    'guard_name' => 'web',
                ], [
                    'module' => $module,
                    'action' => $action,
                ]);
            }

            DB::commit();

            return redirect()->route('admin.permissions.index')
                ->with('success', 'Permissions created successfully.');
        } catch (ValidationException $exception) {
            DB::rollBack();

            throw $exception;
        } catch (Exception $exception) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Permission creation failed. Please try again.');
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
    public function edit(Permission $permission)
    {
        $permissions = Permission::where('module', $permission->module)
            ->orderBy('action')
            ->get();

        return view('admin.permissions.edit', compact('permission', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'module' => ['required', 'string', 'max:255'],
            'actions' => ['required', 'array', 'min:1'],
            'actions.*' => ['required', 'string', 'max:255', 'distinct:ignore_case'],
        ]);

        DB::beginTransaction();

        try {
            $module = Str::lower(trim($request->module));
            $oldModule = $permission->module;
            $actions = collect($request->actions)
                ->map(fn ($action) => Str::lower(trim($action)))
                ->filter()
                ->unique()
                ->values();

            if ($module === '') {
                throw ValidationException::withMessages([
                    'module' => 'Please enter a valid module name.',
                ]);
            }

            if ($actions->isEmpty()) {
                throw ValidationException::withMessages([
                    'actions' => 'Please add at least one permission action.',
                ]);
            }

            $names = $actions->map(fn ($action) => $module . '.' . $action);
            $currentIds = Permission::where('module', $oldModule)->pluck('id');

            if (Permission::whereIn('name', $names)
                ->where('guard_name', 'web')
                ->whereNotIn('id', $currentIds)
                ->exists()) {
                throw ValidationException::withMessages([
                    'actions' => 'One or more module action permissions already exist.',
                ]);
            }

            Permission::where('module', $oldModule)
                ->whereNotIn('action', $actions)
                ->delete();

            $existingPermissions = Permission::where('module', $oldModule)->get()->keyBy('action');

            foreach ($actions as $action) {
                if ($existingPermissions->has($action)) {
                    $existingPermissions->get($action)->update([
                        'name' => $module . '.' . $action,
                        'module' => $module,
                        'action' => $action,
                        'guard_name' => 'web',
                    ]);

                    continue;
                }

                Permission::firstOrCreate([
                    'name' => $module . '.' . $action,
                    'guard_name' => 'web',
                ], [
                    'module' => $module,
                    'action' => $action,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('admin.permissions.index')
                ->with('success', 'Permission updated successfully.');
        } catch (ValidationException $exception) {
            DB::rollBack();

            throw $exception;
        } catch (Exception $exception) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Permission update failed. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        DB::beginTransaction();

        try {
            Permission::where('module', $permission->module)->delete();

            DB::commit();

            return redirect()
                ->route('admin.permissions.index')
                ->with('success', 'Permission deleted successfully.');
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->with('error', 'Permission delete failed. Please try again.');
        }
    }
}
