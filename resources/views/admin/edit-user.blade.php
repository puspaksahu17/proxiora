@extends('layouts.dashboard')
@section('title', 'Edit '.$user->role)
@section('content')
    <a class="button secondary" href="{{ route('dashboard') }}">← Back to dashboard</a>
    <div class="card" style="max-width:650px;margin-top:22px"><h1>Edit {{ $user->role }}</h1><p class="lead">Leave password fields empty to keep the existing password.</p>
    <form method="POST" action="{{ route('admin.users.update', $user) }}">@csrf @method('PATCH')
        <label for="name">Full name</label><input class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>@error('name')<p class="error">{{ $message }}</p>@enderror
        <label for="email">Email</label><input class="form-control" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required>@error('email')<p class="error">{{ $message }}</p>@enderror
        <label for="mobile">Mobile</label><input class="form-control" id="mobile" name="mobile" value="{{ old('mobile', $user->mobile) }}" required>@error('mobile')<p class="error">{{ $message }}</p>@enderror
        @if ($user->role === 'student')<label>Work status</label><label><input type="radio" name="work_status" value="experience" @checked(old('work_status', $user->work_status) === 'experience')> Experienced</label><label><input type="radio" name="work_status" value="fresher" @checked(old('work_status', $user->work_status) === 'fresher')> Fresher</label>@error('work_status')<p class="error">{{ $message }}</p>@enderror
        <label for="progress">Progress (%)</label><input class="form-control" id="progress" name="progress" type="number" min="0" max="100" value="{{ old('progress', $user->progress) }}" required>@error('progress')<p class="error">{{ $message }}</p>@enderror @endif
        <label for="password">New password <small>(optional)</small></label><input class="form-control" id="password" name="password" type="password">@error('password')<p class="error">{{ $message }}</p>@enderror
        <label for="password_confirmation">Confirm new password</label><input class="form-control" id="password_confirmation" name="password_confirmation" type="password">
        <button class="button" style="margin-top:24px" type="submit">Save changes</button>
    </form></div>
@endsection
