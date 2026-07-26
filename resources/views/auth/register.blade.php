@extends('layouts.auth')

@section('title', 'Create account')

@section('content')
    <h1>Create your account</h1>
    <p>Register to get started with Proxiora.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name">
        @error('name') <p class="error">{{ $message }}</p> @enderror

        <label for="email">Email address</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <label for="mobile">Mobile number</label>
        <input id="mobile" name="mobile" type="tel" value="{{ old('mobile') }}" required autocomplete="tel">
        @error('mobile') <p class="error">{{ $message }}</p> @enderror

        <label>Work status</label>
        <label class="check"><input name="work_status" type="radio" value="experience" @checked(old('work_status') === 'experience') required> Experienced</label>
        <label class="check"><input name="work_status" type="radio" value="fresher" @checked(old('work_status') === 'fresher') required> Fresher</label>
        @error('work_status') <p class="error">{{ $message }}</p> @enderror

        <label for="password">Password</label>
        <input id="password" name="password" type="password" required autocomplete="new-password">
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <label for="password_confirmation">Confirm password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">

        <button type="submit">Create account</button>
    </form>

    <p style="font-size:.8rem; margin-top:16px;">By clicking Register, you agree to the <a href="{{ route('terms') }}" target="_blank" rel="noopener">Terms and Conditions</a> &amp; <a href="{{ route('privacy') }}" target="_blank" rel="noopener">Privacy Policy</a> of Proxiora.</p>

    <p class="footer">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
@endsection
