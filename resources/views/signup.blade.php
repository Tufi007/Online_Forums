@extends('layouts.app')
@section('content')
<div>
<h3>Sign Up Form</h3>

    <form action="{{ route('signup.submit') }}" method="POST">
        @csrf
        <div>
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="cpassword">Confirm Password</label>
            <input type="password" name="cpassword" id="cpassword">
        </div>
        <div>
            <strong id="password-error"></strong>
        </div>
        <div>
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number">
        </div>
        <div>
            <label for="alternate_phone_number">Alternate Phone Number</label>
            <input type="text" name="alternate_phone_number" id="alternate_phone_number">
        </div>
        <div>
            <button type="submit" name="signup" id="signup-button">Sign-up!</button>
        </div>
    </form>
</div>
@endsection
<script src="{{ asset('js/signup.js') }}"></script>
