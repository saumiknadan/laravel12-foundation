@extends('layouts.master')

@section('title') Edit Permission @endsection

@section('css')
    
@endsection

@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 pb-0 d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <h4 class="fs-20 font-w700 mb-1">Edit Permission</h4>
                    <span class="fs-14">Update the module and one or more permission actions.</span>
                </div>
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>

            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="module" class="form-label">Module Name</label>
                        <input
                            type="text"
                            id="module"
                            name="module"
                            value="{{ old('module', $permission->module) }}"
                            class="form-control @error('module') is-invalid @enderror"
                            required
                        >
                        @error('module')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <label class="form-label">Permission Actions</label>
                    <div id="action-wrapper">
                        @foreach(old('actions', $permissions->pluck('action')->toArray()) as $action)
                            <div class="input-group mb-2 action-row">
                                <input
                                    type="text"
                                    name="actions[]"
                                    value="{{ $action }}"
                                    class="form-control @error('actions.*') is-invalid @enderror"
                                    required
                                >
                                <button type="button" class="btn btn-outline-danger remove-action">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    @error('actions')
                        <div class="text-danger fs-12 mb-2">{{ $message }}</div>
                    @enderror
                    @error('actions.*')
                        <div class="text-danger fs-12 mb-2">{{ $message }}</div>
                    @enderror

                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <button type="button" id="add-action" class="btn btn-outline-primary">
                            <i class="fas fa-plus me-1"></i> Add Action
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Permission
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const wrapper = document.getElementById('action-wrapper');
            const addButton = document.getElementById('add-action');

            addButton.addEventListener('click', function () {
                const row = document.createElement('div');
                row.className = 'input-group mb-2 action-row';
                row.innerHTML = `
                    <input type="text" name="actions[]" class="form-control" placeholder="create" required>
                    <button type="button" class="btn btn-outline-danger remove-action">
                        <i class="fas fa-trash"></i>
                    </button>
                `;
                wrapper.appendChild(row);
            });

            wrapper.addEventListener('click', function (event) {
                const removeButton = event.target.closest('.remove-action');

                if (!removeButton || wrapper.querySelectorAll('.action-row').length === 1) {
                    return;
                }

                removeButton.closest('.action-row').remove();
            });
        });
    </script>
@endpush
