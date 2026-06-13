@extends('auth.partials.master')

@section('auth-title') Verify Email @endsection

@section('auth-style')  @endsection

@section('auth-content')
    <div class="text-center mb-3">
        <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/logo-full.png') }}" alt=""></a>
    </div>

    <h4 class="text-center mb-3">Verify Email</h4>
    <p class="text-center mb-4">Before getting started, please verify your email address by clicking the link we emailed to you.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-block">Resend Verification Email</button>
        </div>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-3">
        @csrf

        <div class="text-center">
            <button type="submit" class="btn btn-outline-primary btn-block">Logout</button>
        </div>
    </form>
@endsection

@push('auth-script')
    
@endpush()
