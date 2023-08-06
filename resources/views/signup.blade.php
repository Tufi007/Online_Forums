@extends('layouts.app')
@section('content')
<div class="form-container signup-form-contaienr">
    <form class="form" action="{{ route('signup.submit') }}" method="POST">
        @csrf
        <div class="form-item">
        <h3>Sign Up Form</h3>
        </div>
        <div class="form-item">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div class="form-item">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email">
        </div>
        <div class="form-item">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="form-item">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="form-item">
            <label for="cpassword">Confirm Password</label>
            <input type="password" name="cpassword" id="cpassword">
        </div>
        <div class="form-item">
            <strong id="password-error"></strong>
        </div>
        <div class="form-item">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number">
        </div>
        <div class="form-item">
            <label for="alternate_phone_number">Alternate Phone Number</label>
            <input type="text" name="alternate_phone_number" id="alternate_phone_number">
        </div>
        <div class="form-item">
            <button class="form-auth-btn" type="submit" name="signup" id="signup-button">Sign-up!</button>
        </div>
    </form>
</div>
@endsection
<script src="{{ asset('js/signup.js') }}"></script>
