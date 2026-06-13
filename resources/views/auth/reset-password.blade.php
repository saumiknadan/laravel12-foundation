@extends('auth.partials.master')

@section('auth-title') Reset Password @endsection

@section('auth-style')  @endsection

@section('auth-content')
    <div class="text-center mb-3">
        <a href="{{ route('login') }}"><img src="{{ asset('assets/images/logo-full.png') }}" alt=""></a>
    </div>

    <h4 class="text-center mb-4">Reset Password</h4>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <label class="mb-1"><strong>Email</strong></label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $request->email) }}" placeholder="Email" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="mb-1"><strong>Password</strong></label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="mb-1"><strong>Confirm Password</strong></label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
        </div>
    </form>
@endsection

@push('auth-script')
    
@endpush()
