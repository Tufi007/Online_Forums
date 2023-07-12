@extends('layouts.app')

@section('content')
    <h3>Login</h3>

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <button type="submit" name="login">Login</button>
        </div>
    </form>
@endsection
