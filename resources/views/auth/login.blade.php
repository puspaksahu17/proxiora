@extends('layouts.auth')

@section('title', 'Sign in')

@section('content')
    <h1>Welcome back</h1>
    <p>Sign in to access your account.</p>

    @if (session('status'))
        <p class="notice">{{ session('status') }}</p>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">Email address</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email">
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <label for="password">Password</label>
        <input id="password" name="password" type="password" required autocomplete="current-password">
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <label class="check"><input name="remember" type="checkbox" value="1"> Remember me</label>
        <button type="submit">Sign in</button>
    </form>

    <p class="footer">New here? <a href="{{ route('register') }}">Create an account</a></p>
@endsection
