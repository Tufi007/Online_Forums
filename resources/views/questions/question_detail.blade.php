@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Question Detail</h1>
    <h2>{{ $question->title }}</h2>
    <p>{{ $question->description }}</p>

    <!-- Display Upvote and Downvote counts -->
    <p>Question Upvotes: {{ $questionVotes->where('vote', 1)->count() }}</p>
    <p>Question Downvotes: {{ $questionVotes->where('vote', 0)->count() }}</p>

    <!-- Upvote Button -->
    <button class="btn btn-primary upvote-button mb-2" data-id="{{ $question->q_id }}" id="question_upvote_btn_{{ $question->q_id }}" onclick="upvoteQuestion(this.id)">Upvote</button>

    <!-- Downvote Button -->
    <button class="btn btn-danger downvote-button mb-2" data-id="{{ $question->q_id }}" id="question_downvote_btn_{{ $question->q_id }}" onclick="downvoteQuestion(this.id)">Downvote</button>

    @if ($question->image)
    <div class="mb-4">
        <button class="btn btn-secondary image-button my-2" data-question-id="{{ $question->q_id }}">View Image(s)</button>
        <div class="image-container" id="image-container-{{ $question->q_id }}" style="display: none;">
            @foreach (json_decode($question->image) as $imagePath)
            <img class="img-fluid" src="{{ asset($imagePath) }}" alt="Question Image">
            @endforeach
        </div>
    </div>
    @endif

    <button id="toggle-answers-button" class="btn btn-primary">View Answers</button>
    <div class="my-4" id="answers-container" style="display: none;">
        @foreach($question->answers as $answer)
        <div class="card mb-4">
            <div class="card-header">
                <p class="text-muted">Answered on: {{ date('d F Y g:i A', strtotime($answer->date_time)) }}</p>
            </div>
            <div class="card-body">
                <p>{{ $answer->answer_text }}</p>

                <!-- Display Upvote and Downvote counts -->
                <p>Answer Upvotes: {{ $answerVotes->where('votable_id', $answer->a_id)->where('vote', 1)->count() }}</p>
                <p>Answer Downvotes: {{ $answerVotes->where('votable_id', $answer->a_id)->where('vote', 0)->count() }}</p>

                <!-- Upvote Button for the answer -->
                <button class="btn btn-primary upvote-button mb-2" data-id="{{ $answer->a_id }}" id="answer_upvote_btn_{{  $answer->a_id }}" onclick="upvoteAnswer(this.id)">Upvote</button>

                <!-- Downvote Button for the answer -->
                <button class="btn btn-danger downvote-button mb-2" data-id="{{ $answer->a_id }}" id="answer_downvote_btn_{{  $answer->a_id }}" onclick="downvoteAnswer(this.id)">Downvote</button>

                <button class="btn btn-primary show-comments-button mb-2" id="show-comments-btn-{{ $answer->a_id }}" data-answer-id="{{ $answer->a_id }}" onclick="showComments(this.id)">Show Comments</button>
                <div class="comments-container" id="comments-container-{{ $answer->a_id }}" style="display: none;">
                    @foreach ($answer->comments as $comment)
                    <div class="card mb-2">
                        <div class="card-header">
                            <strong>{{ $comment->user->name }}</strong>
                            <small class="text-muted">{{ $comment->user->username }}</small>
                        </div>
                        <div class="card-body">{{ $comment->comment_text }}</div>
                    </div>
                    @endforeach
                </div>

                @auth
                <!-- Comment Form -->
                <form action="{{ route('submit_comment') }}" method="POST">
                    @csrf
                    <textarea class="form-control comment-textarea mb-2" name="comment_text" data-answer-id="{{ $answer->a_id }}"></textarea>
                    <input type="hidden" name="answer_id" value="{{ $answer->a_id }}">
                    <input type="hidden" name="question_id" value="{{ $question->q_id }}">
                    <button class="btn btn-primary" type="submit">Comment</button>
                </form>
                @endauth

                <button class="btn btn-primary toggle-image-button mt-2">Toggle Image</button>
                @if ($answer->image)
                <div class="image-container" style="display: none;">
                    @foreach(json_decode($answer->image) as $image)
                    <img class="img-fluid answer-image" src="{{ asset($image) }}">
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @auth
    <a class="btn btn-success" href="{{ route('answer_form', ['question_id' => $question->q_id]) }}">Answer this question</a>
    @else
    <button class="btn btn-warning" onclick="alert('You must log in first to answer this question.')">Answer this question</button>
    @endauth
</div>
@endsection
