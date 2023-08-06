@extends('layouts.app')

@section('content')
<div class="form-container login-form-container">
    <form class="form" action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="form-item">
            <h3>Login</h3>

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
            <button class="form-auth-btn" type="submit" name="login">Login</button>
        </div>
    </form>
</div>

@endsection
