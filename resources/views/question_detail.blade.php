@extends('layouts.app')

@section('content')
    <h1>Question Detail</h1>
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
    <button id="toggle-answers-button">View Answers</button>
    <div id="answers-container" style="display: none;">
        @foreach($question->answers as $answer)
            <div>
            <p>Answered on: {{ date('d F Y g:i A', strtotime($answer->date_time)) }}</p>
                <p>{{ $answer->answer_text }}</p>
                <button class="toggle-image-button">Toggle Image</button>
                @if ($answer->image)
                    @foreach(json_decode($answer->image) as $image)
                        <img src="{{ asset($image) }}" class="answer-image" style="display: none;">
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>
@endsection

