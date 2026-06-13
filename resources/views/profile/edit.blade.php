@extends('layouts.master')

@section('title') Profile @endsection

@section('content')
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h4 class="card-title mb-1">Profile Information</h4>
                    <span>Update your account's profile information and email address.</span>
                </div>
            </div>
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h4 class="card-title mb-1">Update Password</h4>
                    <span>Ensure your account is using a long, random password to stay secure.</span>
                </div>
            </div>
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <div>
                    <h4 class="card-title mb-1 text-danger">Delete Account</h4>
                    <span>Once your account is deleted, all of its resources and data will be permanently deleted.</span>
                </div>
            </div>
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
