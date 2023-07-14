@extends('layouts.app')
@section('content')
@auth
<a href="{{ route('ask_form') }}">Ask a Question</a>
@endauth

<h1>Questions</h1>

@foreach ($questions as $question)
<div class="question">
    <p>Asked By: {{ $question->user->name }} <br> Username: {{ $question->user->username }}</p>
    <p>Asked on: {{ date('d F Y g:i A', strtotime($question->date_time)) }}</p>


    <h2>{{ $question->title }}</h2>
    <p>{{ $question->description }}</p>



    @if ($question->image)
    <button class="image-button" data-question-id="{{ $question->q_id }}">View Image(s)</button>
    <div class="image-container" id="image-container-{{ $question->q_id }}" style="display: none;">
        @foreach (json_decode($question->image) as $imagePath)
        <img src="{{ asset($imagePath) }}" alt="Question Image">
        @endforeach
    </div>
    @endif
    <a href="{{ route('question_detail', ['question_id' => $question->q_id]) }}">
        View Full Question ({{ $question->answers()->count() }} answers)
    </a>
    @auth
    <a href="{{ route('answer_form', ['question_id' => $question->q_id]) }}">Answer this question</a>
    @else
    <button onclick="alert('You must login first in order to answer the questions on this platform.')">Answer this question</button>
    @endauth
</div>
@endforeach




@endsection
