<div class="mb-3">
    <label class="form-label">Role Name</label>
    <input
        type="text"
        name="name"
        value="{{ old('name', $role->name ?? '') }}"
        class="form-control @error('name') is-invalid @enderror"
        placeholder="Advisor"
    >
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label class="form-label">Permissions</label>

    @error('permissions')
        <div class="text-danger mb-2">{{ $message }}</div>
    @enderror

    @forelse($permissionGroups as $module => $permissions)
        @php($moduleId = 'module-' . \Illuminate\Support\Str::slug($module))
        <div class="border rounded p-3 mb-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                <h5 class="mb-0 text-capitalize">{{ $module }}</h5>
                <div class="form-check">
                    <input
                        type="checkbox"
                        class="form-check-input js-module-check"
                        id="{{ $moduleId }}"
                        data-module="{{ $moduleId }}"
                    >
                    <label class="form-check-label" for="{{ $moduleId }}">Select all</label>
                </div>
            </div>

            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-sm-6 col-lg-3">
                        <div class="form-check mb-2">
                            <input
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $permission->id }}"
                                class="form-check-input js-permission-check"
                                id="permission-{{ $permission->id }}"
                                data-module="{{ $moduleId }}"
                                @checked(in_array($permission->id, $assignedPermissions))
                            >
                            <label class="form-check-label text-capitalize" for="permission-{{ $permission->id }}">
                                {{ $permission->action }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="alert alert-info">No permissions found. Please create permissions first.</div>
    @endforelse
</div>

<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('admin.roles.index') }}" class="btn btn-light">Cancel</a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i> Save Role
    </button>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const moduleChecks = document.querySelectorAll('.js-module-check');
            const permissionChecks = document.querySelectorAll('.js-permission-check');

            function refreshModuleCheck(moduleId) {
                const moduleCheck = document.querySelector('.js-module-check[data-module="' + moduleId + '"]');
                const checks = document.querySelectorAll('.js-permission-check[data-module="' + moduleId + '"]');
                const checked = document.querySelectorAll('.js-permission-check[data-module="' + moduleId + '"]:checked');

                moduleCheck.checked = checks.length > 0 && checks.length === checked.length;
                moduleCheck.indeterminate = checked.length > 0 && checks.length !== checked.length;
            }

            moduleChecks.forEach(function (moduleCheck) {
                refreshModuleCheck(moduleCheck.dataset.module);

                moduleCheck.addEventListener('change', function () {
                    document
                        .querySelectorAll('.js-permission-check[data-module="' + moduleCheck.dataset.module + '"]')
                        .forEach(function (permissionCheck) {
                            permissionCheck.checked = moduleCheck.checked;
                        });

                    refreshModuleCheck(moduleCheck.dataset.module);
                });
            });

            permissionChecks.forEach(function (permissionCheck) {
                permissionCheck.addEventListener('change', function () {
                    refreshModuleCheck(permissionCheck.dataset.module);
                });
            });
        });
    </script>
@endpush
