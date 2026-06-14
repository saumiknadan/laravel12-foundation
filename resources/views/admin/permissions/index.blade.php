@extends('layouts.master')

@section('title') Permission List @endsection

@section('css')
    
@endsection

@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 pb-0 d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <h4 class="fs-20 font-w700 mb-1">Permission List</h4>
                    <span class="fs-14">Permissions are grouped by module.</span>
                </div>
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Create Permission
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

                <form action="{{ route('admin.permissions.index') }}" method="GET" class="row g-2 align-items-center mb-4">
                    <div class="col-md-5">
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="form-control"
                            placeholder="Search module or action"
                        >
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-1"></i> Search
                        </button>
                        @if($search)
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-light">Reset</a>
                        @endif
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th>Module Name</th>
                                <th>Action Name</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permissions as $module => $items)
                                @php($firstPermission = $items->first())
                                <tr>
                                    <td class="text-capitalize font-w600">{{ $module }}</td>
                                    <td>
                                        @foreach($items as $permission)
                                            <span class="badge badge-primary light me-1 mb-1">{{ $permission->action }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.permissions.edit', $firstPermission) }}" class="btn btn-xs btn-primary">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button
                                            type="button"
                                            class="btn btn-xs btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deletePermissionModal"
                                            data-delete-url="{{ route('admin.permissions.destroy', $firstPermission) }}"
                                            data-module="{{ $module }}"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="alert alert-info mb-0">No permissions found.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $permissions->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletePermissionModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Permission Module</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to delete all permissions for <strong id="delete-module-name"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <form id="delete-permission-form" method="POST">
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
            const deleteModal = document.getElementById('deletePermissionModal');
            const deleteForm = document.getElementById('delete-permission-form');
            const moduleName = document.getElementById('delete-module-name');

            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                deleteForm.action = button.getAttribute('data-delete-url');
                moduleName.textContent = button.getAttribute('data-module');
            });
        });
    </script>
@endpush
