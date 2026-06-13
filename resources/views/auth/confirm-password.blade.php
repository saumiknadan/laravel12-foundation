@extends('auth.partials.master')

@section('auth-title') Confirm Password @endsection

@section('auth-style')  @endsection

@section('auth-content')
    <div class="text-center mb-3">
        <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/logo-full.png') }}" alt=""></a>
    </div>

    <h4 class="text-center mb-3">Confirm Password</h4>
    <p class="text-center mb-4">This is a secure area. Please confirm your password before continuing.</p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label class="mb-1"><strong>Password</strong></label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-block">Confirm</button>
        </div>
    </form>

    <div class="new-account mt-3">
        <p><a class="text-primary" href="{{ route('dashboard') }}">Back to Dashboard</a></p>
    </div>
@endsection

@push('auth-script')
    
@endpush()
