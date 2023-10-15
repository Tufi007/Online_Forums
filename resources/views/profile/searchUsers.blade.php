@extends('layouts.app')

@section('content')
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Search Users</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('searchUsers') }}">
                        @csrf

                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="search_query" class="form-control" placeholder="Search for users">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    @if(isset($users))
                    @if(count($users) > 0)
                    <h2>Search Results</h2>
                    <ul class="list-group">
                        @foreach($users as $user)
                        <li class="list-group-item">
                            {{ $user->name }} ({{ $user->email }})
                            @if($user->hasProfile())
                            <a href="{{ route('viewProfile', ['id' => $user->id]) }}" class="btn btn-primary float-right">View Profile</a>
                            @else
                            <span class="text-danger float-right">No Profile</span>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="mt-3">No users found.</p>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
