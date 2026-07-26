@extends('layouts.dashboard')
@section('title', 'Create subadmin')
@section('content')
    <a class="button secondary" href="{{ route('dashboard') }}">← Back to dashboard</a>
    <div class="card" style="max-width:620px;margin-top:22px"><h1>Create subadmin</h1><p class="lead">Only administrators can create subadmin accounts.</p><form method="POST" action="{{ route('admin.subadmins.store') }}">@csrf
        <label for="name">Full name</label><input class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>@error('name')<p class="error">{{ $message }}</p>@enderror
        <label for="email">Email</label><input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" required>@error('email')<p class="error">{{ $message }}</p>@enderror
        <label for="mobile">Mobile</label><input class="form-control" id="mobile" name="mobile" type="tel" value="{{ old('mobile') }}" required>@error('mobile')<p class="error">{{ $message }}</p>@enderror
        <label for="password">Password</label><input class="form-control" id="password" name="password" type="password" required>@error('password')<p class="error">{{ $message }}</p>@enderror
        <label for="password_confirmation">Confirm password</label><input class="form-control" id="password_confirmation" name="password_confirmation" type="password" required>
        <button class="button" style="margin-top:24px" type="submit">Create subadmin</button></form></div>
@endsection
