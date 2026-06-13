<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label"><strong>Name</strong></label>
            <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6 mb-3">
            <label for="email" class="form-label"><strong>Email</strong></label>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="alert alert-warning">
            <p class="mb-2">Your email address is unverified.</p>
            <button form="send-verification" type="submit" class="btn btn-sm btn-warning">Click here to re-send the verification email.</button>

            @if (session('status') === 'verification-link-sent')
                <p class="text-success mt-2 mb-0">A new verification link has been sent to your email address.</p>
            @endif
        </div>
    @endif

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Save</button>

        @if (session('status') === 'profile-updated')
            <span class="text-success ms-2">Saved.</span>
        @endif
    </div>
</form>
