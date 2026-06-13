@extends('auth.partials.master')

@section('auth-title') Sign In @endsection

@section('auth-style')  @endsection

@section('auth-content')
    <div class="text-center mb-3">
        <a href="{{ route('login') }}"><img src="{{ asset('assets/images/logo-full.png') }}" alt=""></a>
    </div>

    <h4 class="text-center mb-4">Sign in your account</h4>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mb-3">
            <label class="mb-1"><strong>Email</strong></label>
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <label class="mb-1"><strong>Password</strong></label>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>

        <div class="row d-flex justify-content-between mt-4 mb-2">
            <div class="mb-3">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                @endif
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
        </div>
    </form>

    <div class="new-account mt-3">
        <p>Don't have an account? <a class="text-primary" href="{{ route('register') }}">Register</a></p>
    </div>
    
@endsection


@push('auth-script')
    
@endpush()


