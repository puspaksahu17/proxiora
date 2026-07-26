@extends('layouts.dashboard')
@section('title', 'My profile')
@section('content')
    <div class="card" style="max-width:650px"><h1>My profile</h1><p class="lead">Update your account details. Leave password fields empty to keep your current password.</p>
    <form method="POST" action="{{ route('profile.update') }}">@csrf @method('PATCH')
        <label for="name">Full name</label><input class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>@error('name')<p class="error">{{ $message }}</p>@enderror
        <label for="email">Email</label><input class="form-control" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required>@error('email')<p class="error">{{ $message }}</p>@enderror
        <label for="mobile">Mobile</label><input class="form-control" id="mobile" name="mobile" value="{{ old('mobile', $user->mobile) }}" required>@error('mobile')<p class="error">{{ $message }}</p>@enderror
        @if ($user->role === 'student')<label>Work status</label><label><input type="radio" name="work_status" value="experience" @checked(old('work_status', $user->work_status) === 'experience')> Experienced</label><label><input type="radio" name="work_status" value="fresher" @checked(old('work_status', $user->work_status) === 'fresher')> Fresher</label>@error('work_status')<p class="error">{{ $message }}</p>@enderror @endif
        <label for="password">New password <small>(optional)</small></label><input class="form-control" id="password" name="password" type="password" autocomplete="new-password">@error('password')<p class="error">{{ $message }}</p>@enderror
        <label for="password_confirmation">Confirm new password</label><input class="form-control" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
        <button class="button" style="margin-top:24px" type="submit">Save changes</button>
    </form></div>
@endsection
