@extends('layouts.master')

@section('title') Role List @endsection

@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 pb-0 d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <h4 class="fs-20 font-w700 mb-1">Role List</h4>
                    <span class="fs-14">Manage roles and granted permissions.</span>
                </div>
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Create Role
                </a>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('admin.roles.index') }}" method="GET" class="row g-2 align-items-center mb-4">
                    <div class="col-md-5">
                        <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search role">
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-1"></i> Search
                        </button>
                        @if($search)
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-light">Reset</a>
                        @endif
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                                <tr>
                                    <td class="font-w600 text-capitalize">{{ str_replace('-', ' ', $role->name) }}</td>
                                    <td>
                                        @if($role->name === 'super-admin')
                                            <span class="badge badge-success light">All permissions</span>
                                            <span class="badge badge-secondary light">System protected</span>
                                        @else
                                            @forelse($role->permissions->groupBy('module') as $module => $permissions)
                                                <span class="badge badge-primary light me-1 mb-1 text-capitalize">
                                                    {{ $module }}: {{ $permissions->pluck('action')->implode(', ') }}
                                                </span>
                                            @empty
                                                <span class="badge badge-warning light">No permissions</span>
                                            @endforelse
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if($role->name !== 'super-admin')
                                            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-xs btn-primary">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <button
                                                type="button"
                                                class="btn btn-xs btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteRoleModal"
                                                data-delete-url="{{ route('admin.roles.destroy', $role) }}"
                                                data-role="{{ str_replace('-', ' ', $role->name) }}"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @else
                                            <span class="badge badge-secondary light">Locked</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="alert alert-info mb-0">No roles found.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $roles->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteRoleModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to delete <strong id="delete-role-name"></strong>? Granted permissions will be removed from this role.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <form id="delete-role-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteModal = document.getElementById('deleteRoleModal');
            const deleteForm = document.getElementById('delete-role-form');
            const roleName = document.getElementById('delete-role-name');

            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                deleteForm.action = button.getAttribute('data-delete-url');
                roleName.textContent = button.getAttribute('data-role');
            });
        });
    </script>
@endpush
