<!-- resources/views/questions/searchQuestions.blade.php -->
@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mt-4">Search Questions</h1>

            <form method="GET" action="{{ route('questions.search') }}" class="mb-3">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search questions" aria-label="Search questions">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            @if(isset($questions) && count($questions) > 0)
            <h2 class="mt-4">Search Results:</h2>
            <ul class="list-group">
                @foreach($questions as $question)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $question->title }}</span>
                    <a href="{{ route('question_detail', ['question_id' => $question->id]) }}" class="btn btn-sm btn-primary">View Full Question</a>
                </li>

                @endforeach
            </ul>
            @else
            <p class="mt-4">No questions found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
