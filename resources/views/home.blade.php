@extends('layouts.app')

@section('content')

    <h1>Welcome to My Website!</h1>
    <p>This is the home page.</p>

    @auth
    <a href="{{ route('ask_form') }}">Ask a Question</a>
@endauth

@endsection
