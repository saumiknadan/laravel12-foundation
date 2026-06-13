@extends('auth.partials.master')

@section('auth-title') Sign In @endsection

@section('auth-style')  @endsection

@section('auth-content')
    <div class="text-center mb-3">
        <a href="{{ route('register') }}"><img src="{{ asset('assets/images/logo-full.png') }}" alt=""></a>
    </div>
    <h4 class="text-center mb-4">Register</h4>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label class="mb-1"><strong>Name</strong></label>
            <input type="text" class="form-control" name="name" placeholder="Name" required>
        </div>
        
        <div class="mb-3">
            <label class="mb-1"><strong>Email</strong></label>
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>


        <div class="mb-3">
            <label class="mb-1"><strong>Password</strong></label>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>

        <div class="mb-3">
            <label class="mb-1"><strong>Confirm Password</strong></label>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>

    </form>

    <div class="new-account mt-3">
        <p>Already have an account? <a class="text-primary" href="{{ route('login') }}">Login</a></p>
    </div>
    
@endsection

@push('auth-script')
    
@endpush()
    


