<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="update_password_current_password" class="form-label"><strong>Current Password</strong></label>
            <input id="update_password_current_password" type="password" name="current_password" class="form-control @if ($errors->updatePassword->has('current_password')) is-invalid @endif" autocomplete="current-password">
            @foreach ($errors->updatePassword->get('current_password') as $message)
                <div class="invalid-feedback">{{ $message }}</div>
            @endforeach
        </div>

        <div class="col-md-4 mb-3">
            <label for="update_password_password" class="form-label"><strong>New Password</strong></label>
            <input id="update_password_password" type="password" name="password" class="form-control @if ($errors->updatePassword->has('password')) is-invalid @endif" autocomplete="new-password">
            @foreach ($errors->updatePassword->get('password') as $message)
                <div class="invalid-feedback">{{ $message }}</div>
            @endforeach
        </div>

        <div class="col-md-4 mb-3">
            <label for="update_password_password_confirmation" class="form-label"><strong>Confirm Password</strong></label>
            <input id="update_password_password_confirmation" type="password" name="password_confirmation" class="form-control @if ($errors->updatePassword->has('password_confirmation')) is-invalid @endif" autocomplete="new-password">
            @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                <div class="invalid-feedback">{{ $message }}</div>
            @endforeach
        </div>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Save</button>

        @if (session('status') === 'password-updated')
            <span class="text-success ms-2">Saved.</span>
        @endif
    </div>
</form>
