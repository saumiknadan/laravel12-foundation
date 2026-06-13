<p class="mb-4">
    Once your account is deleted, all of its resources and data will be permanently deleted.
    Please enter your password to confirm you would like to permanently delete your account.
</p>

<form method="post" action="{{ route('profile.destroy') }}">
    @csrf
    @method('delete')

    <div class="row align-items-end">
        <div class="col-md-6 mb-3">
            <label for="delete_password" class="form-label"><strong>Password</strong></label>
            <input id="delete_password" type="password" name="password" class="form-control @if ($errors->userDeletion->has('password')) is-invalid @endif" placeholder="Password">
            @foreach ($errors->userDeletion->get('password') as $message)
                <div class="invalid-feedback">{{ $message }}</div>
            @endforeach
        </div>

        <div class="col-md-6 mb-3">
            <button type="submit" class="btn btn-danger">Delete Account</button>
        </div>
    </div>
</form>
