@extends('auth.partials.master')

@section('auth-title') Forgot Password @endsection

@section('auth-style')  @endsection

@section('auth-content')
    <div class="text-center mb-3">
        <a href="{{ route('login') }}"><img src="{{ asset('assets/images/logo-full.png') }}" alt=""></a>
    </div>

    <h4 class="text-center mb-3">Forgot Password</h4>
    <p class="text-center mb-4">Enter your email address and we will send you a password reset link.</p>

    @if (session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label class="mb-1"><strong>Email</strong></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
        </div>
    </form>

    <div class="new-account mt-3">
        <p>Remember your password? <a class="text-primary" href="{{ route('login') }}">Login</a></p>
    </div>
@endsection

@push('auth-script')
    
@endpush()
