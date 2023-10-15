@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <button class="btn btn-primary" id="toggle-sidebar">Sidebar</button>
            <div class="sidebar" id="sidebar">
                <ul class="list-group">
                    @auth
                    <li class="list-group-item"><a href="{{ route('ask_form') }}">Ask a Question</a></li>
                    @endauth
                    <li class="list-group-item"><a href="{{ route('global_questions') }}">Global Questions</a></li>
                    <li class="list-group-item"><a href="{{ route('showSearchUsers') }}">Search Users</a>
                    </li>
                    <li class="list-group-item"><a href="#">Sample Button 2</a></li>
                    <li class="list-group-item"><a href="#">Sample Button 3</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Introduction Section starts -->
@include('components.introduction')
<!-- Introduction Section ends -->

<script src="{{ asset('js/home.js') }}"></script>
@endsection
