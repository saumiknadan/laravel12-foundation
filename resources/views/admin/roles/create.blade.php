@extends('layouts.master')

@section('title') Create Role @endsection

@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header border-0 pb-0 d-flex flex-wrap align-items-center justify-content-between">
                <div>
                    <h4 class="fs-20 font-w700 mb-1">Create Role</h4>
                    <span class="fs-14">Choose permissions grouped by module.</span>
                </div>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Please check the form and try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.roles.store') }}">
                    @csrf
                    @include('admin.roles.partials.form', [
                        'permissionGroups' => $permissionGroups,
                        'assignedPermissions' => old('permissions', []),
                    ])
                </form>
            </div>
        </div>
    </div>
@endsection
