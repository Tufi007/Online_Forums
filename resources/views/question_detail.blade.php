@extends('layouts.app')

@section('content')
<h1>Question Detail</h1>
<h2>{{ $question->title }}</h2>
<p>{{ $question->description }}</p>

<!-- Display Upvote and Downvote counts -->
<p>Question Upvotes: {{ $questionVotes->where('vote', 1)->count() }}</p>
<p>Question Downvotes: {{ $questionVotes->where('vote', 0)->count() }}</p>

<!-- Upvote Button -->
<button class="upvote-button" data-id="{{ $question->q_id }}" id="question_upvote_btn_{{ $question->q_id }}" onclick="upvoteQuestion(this.id)">Upvote</button>

<!-- Downvote Button -->
<button class="downvote-button" data-id="{{ $question->q_id }}" id="question_downvote_btn_{{ $question->q_id }}" onclick="downvoteQuestion(this.id)">Downvote</button>


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

        <!-- Display Upvote and Downvote counts -->
        <p>Answer Upvotes: {{ $answerVotes->where('votable_id', $answer->a_id)->where('vote', 1)->count() }}</p>
        <p>Answer Downvotes: {{ $answerVotes->where('votable_id', $answer->a_id)->where('vote', 0)->count() }}</p>

        <!-- Upvote Button for the answer -->
        <button class="upvote-button" data-id="{{ $answer->a_id }}" id="answer_upvote_btn_{{  $answer->a_id }}" onclick="upvoteAnswer(this.id)">Upvote</button>

        <!-- Downvote Button for the answer -->
        <button class="downvote-button" data-id="{{ $answer->a_id }}" id="answer_downvote_btn_{{  $answer->a_id }}" onclick="downvoteAnswer(this.id)">Downvote</button>

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
