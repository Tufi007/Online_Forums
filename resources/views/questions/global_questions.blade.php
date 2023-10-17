@extends('layouts.app')

@section('content')
<div class="container">
    @auth
    <a class="btn btn-primary mb-3 my-3" href="{{ route('ask_form') }}">Ask a Question</a>
    @endauth
    <div class="mb-3">
        <label for="subjectFilter" class="form-label">Filter by Subject:</label>
        <select class="form-select" id="subjectFilter" onchange="filterBySubject(this)">
            <option value="">All Questions</option>
            @foreach ($subjects as $subjectOption)
            <option value="{{ $subjectOption->id }}" {{ (isset($subject) && $subjectOption->id == $subject) ? 'selected' : '' }}>
                {{ $subjectOption->title }}
            </option>
            @endforeach
        </select>
    </div>

    <h1 class="mb-4">Questions</h1>
    @if($questions->isEmpty())
    <div class="alert alert-info" role="alert">
        No questions found.
    </div>
    @endif

    @foreach ($questions as $question)
    <div class="card mb-4">
        <div class="card-header">
            <p class="mb-0">Asked By: {{ $question->user->name }}</p>
            <p class="text-muted">Username: {{ $question->user->username }}</p>
            <p class="text-muted">Asked on: {{ date('d F Y g:i A', strtotime($question->date_time)) }}</p>
        </div>
        <div class="card-body">
            <h2 class="card-title">{{ $question->title }}</h2>
            <p class="card-text">{{ $question->description }}</p>

            @if ($question->image)
            <button class="btn btn-secondary  image-button" data-question-id="{{ $question->id }}">
                View Image(s)
            </button>
            <div class="image-container mb-3" id="image-container-{{ $question->id }}" style="display: none;">
                @foreach (json_decode($question->image) as $imagePath)
                <img class="img-fluid" src="{{ asset($imagePath) }}" alt="Question Image">
                @endforeach
            </div>
            @endif

            <a class="btn btn-primary" href="{{ route('question_detail', ['question_id' => $question->id]) }}">
                View Full Question ({{ $question->answers()->count() }} answers)
            </a>

            @auth
            <a class="btn btn-success" href="{{ route('answer_form', ['question_id' => $question->id]) }}">
                Answer this question
            </a>
            @else
            <button class="btn btn-warning" onclick="alert('You must log in first to answer the questions on this platform.')">
                Answer this question
            </button>
            @endauth
        </div>
    </div>
    @endforeach
</div>
<script>
    function filterBySubject(select) {
        const selectedSubject = select.value;
        if (selectedSubject) {
            window.location.href = "{{ route('questions.index') }}/" + selectedSubject;
        } else {
            window.location.href = "{{ route('questions.index') }}";
        }
    }
</script>
@endsection
