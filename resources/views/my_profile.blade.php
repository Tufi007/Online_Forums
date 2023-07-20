@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-md-3">
            <h4>Profile</h4>
            <ul>
                <li><button onclick="showData('profile')">Edit/Update Profile</button></li>
                <li><button onclick="showData('questions')">My Questions</button></li>
                <li><button onclick="showData('answers')">My Answers</button></li>
                <li><button onclick="showData('comments')">My Comments</button></li>
            </ul>
        </aside>
        <main class="col-md-9">
            <!-- Profile data -->
            <div id="profileData" style="display: none;">
                <h2>This is the profile data</h2>
                <p>Name: {{ $user->name }}</p>
                <p>Email: {{ $user->email }}</p>
                <!-- Add other profile fields here -->
            </div>

            <!-- My questions data -->
            <div id="questionsData" style="display: none;">
                <h2>This is the questions data</h2>
                <ul>
                    @foreach ($user->questions as $question)
                        <li>{{ $question->title }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- My answers data -->
            <div id="answersData" style="display: none;">
                <h2>This is the answers data</h2>
                <ul>
                    @foreach ($user->answers as $answer)
                        <li>{{ $answer->answer_text }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- My comments data -->
            <div id="commentsData" style="display: none;">
                <h2>This is the comments data</h2>
                <ul>
                    @foreach ($user->comments as $comment)
                        <li>{{ $comment->comment_text }}</li>
                    @endforeach
                </ul>
            </div>
        </main>
    </div>
@endsection
