@extends('layouts.app')

@section('content')
<div class="container mt-4">
    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
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

    <div class="row">
        <aside class="col-md-3">
            <div class="list-group">
                <h4 class="list-group-item list-group-item-primary">Profile Settings</h4>
                <button class="list-group-item list-group-item-action" onclick="showData('profile')">Edit/Update Profile</button>
                <button class="list-group-item list-group-item-action" onclick="showData('changePassword')">Change Password</button>
                <button class="list-group-item list-group-item-action" onclick="showData('questions')">My Questions</button>
                <button class="list-group-item list-group-item-action" onclick="showData('answers')">My Answers</button>
                <button class="list-group-item list-group-item-action" onclick="showData('comments')">My Comments</button>
                <button class="list-group-item list-group-item-action" onclick="showData('deleteAccount')">Delete My Account</button>
            </div>
        </aside>
        <main class="col-md-9">
            <!-- Profile data -->
            <div class="container mt-4" id="profileData" style="display: none;">
                <!-- User Data Form -->
                <form class="form" method="post" action="{{ route('update_user_data') }}">
                    @csrf
                    <div class="mb-3">
                        <h2>Edit User Data</h2>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" name="username" value="{{ $user->username }}" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="country_code" class="form-label">Country Code</label>
                        <input type="text" class="form-control" name="country_code" value="{{ $user->country_code }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number:</label>
                        <input type="text" class="form-control" name="phone_number" value="{{ $user->phone_number }}" required>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Update User Data</button>
                    </div>
                </form>

                <!-- Profile Data Form -->
                @if (isset($user->profiles))
                <div class="container mt-4">
                    <form class="form" method="post" action="{{ route('update_profile_data') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <h2>Edit Profile Data</h2>
                        </div>
                        @if ($user->profiles && $user->profiles->profile_picture)
                        <div class="mb-3">
                            <img src="{{ asset($user->profiles->profile_picture) }}" alt="Profile Picture" class="img-fluid">
                        </div>
                        @endif
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture:</label>
                            <input type="file" class="form-control" name="profile_picture">
                        </div>
                        <div class="mb-3">
                            <label for="street_address" class="form-label">Street Address</label>
                            <input type="text" class="form-control" name="street_address" value="{{ $user->profiles->street_address }}">
                        </div>
                        <div class="mb-3">
                            <label for="state_city" class="form-label">State and City</label>
                            <input type="text" class="form-control" name="state_city" value="{{ $user->profiles->state_city }}">
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" name="country" value="{{ $user->profiles->country }}">
                        </div>
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth" value="{{ $user->profiles->date_of_birth }}">
                        </div>
                        <div class="mb-3">
                            <label for="academic_qualification" class="form-label">Academic Qualification</label>
                            <input type="text" class="form-control" name="academic_qualification" value="{{ $user->profiles->academic_qualification }}">
                        </div>
                        <div class="mb-3">
                            <label for="work_experience" class="form-label">Work Experience</label>
                            <textarea class="form-control" name="work_experience" rows="5">{{ $user->profiles->work_experience }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="about_you" class="form-label">About You</label>
                            <textarea class="form-control" name="about_you" rows="5">{{ $user->profiles->about_you }}</textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Update Profile Data</button>
                        </div>
                    </form>
                </div>
                @else
                <div class="container mt-4">
                    <form method="post" action="{{ route('create_profile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <p>No profile data found. Create a profile.</p>
                        </div>
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture:</label>
                            <input type="file" class="form-control" name="profile_picture">
                        </div>
                        <div class="mb-3">
                            <label for="street_address" class="form-label">Street Address</label>
                            <input type="text" class="form-control" name="street_address">
                        </div>
                        <div class="mb-3">
                            <label for="state_city" class="form-label">State and City</label>
                            <input type="text" class="form-control" name="state_city">
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" class="form-control" name="country">
                        </div>
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth">
                        </div>
                        <div class="mb-3">
                            <label for="academic_qualification" class="form-label">Academic Qualification</label>
                            <input type="text" class="form-control" name="academic_qualification">
                        </div>
                        <div class="mb-3">
                            <label for="work_experience" class="form-label">Work Experience</label>
                            <textarea class="form-control" name="work_experience" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="about_you" class="form-label">About You</label>
                            <textarea class="form-control" name="about_you" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Create Profile</button>
                        </div>
                    </form>
                </div>
                @endif
            </div>

            <!-- Change Password -->
            <div class="form-container" id="changePasswordData" style="display: none;">
                <form class="form" method="POST" action="{{ route('change_password') }}" onsubmit="return validatePassword()">
                    @csrf
                    <h4 class="mb-4">Change Password</h4>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" name="current_password">
                    </div>
                    <!-- ... Other input fields ... -->
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Change Password</button>
                    </div>
                </form>
            </div>
            <!-- My questions data -->
            <div id="questionsData" class="mt-4" style="display: none;">
                <h2 class="mb-3">This is the questions data</h2>
                <ul class="list-group">
                    @foreach ($user->questions as $question)
                    <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                        {{ $question->title }}
                        <a href="{{ route('edit_question', ['question_id' => $question->id]) }}" class="btn btn-primary">Edit</a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- My answers data -->
            <div id="answersData" class="mt-4" style="display: none;">
                <h2 class="mb-3">This is the answers data</h2>
                <ul class="list-group">
                    @foreach ($user->answers as $answer)
                    <li class="list-group-item d-flex justify-content-between align-items-center mb-2">
                        {{ $answer->answer_text }}
                        <a href="{{ route('edit_answer', ['answer_id' => $answer->id]) }}" class="btn btn-primary">Edit</a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- My comments data -->
            <div id="commentsData" class="mt-4">
                <h2 class="mb-3">This is the comments data</h2>
                <ul class="list-group">
                    @foreach ($user->comments as $comment)
                    <li id="comment-{{ $comment->id }}" class="list-group-item d-flex justify-content-between align-items-center mb-2">
                        {{ $comment->comment_text }}
                        <div class="btn-group">
                            <button class="btn btn-primary edit-comment-button mx-2" data-comment-id="{{ $comment->id }}">Edit</button>
                            <a href="{{ route('question_detail', ['question_id' => $comment->question->id]) }}" class="btn btn-primary">Question</a>
                        </div>
                    </li>
                    <li id="edit-form-{{ $comment->id }}" style="display: none;" class="mt-2">
                        <form id="editCommentForm-{{ $comment->id }}" method="post" action="{{ route('update_comment', ['comment_id' => $comment->id]) }}">
                            @csrf
                            <div class="form-group">
                                <label for="comment_text">Comment Text:</label>
                                <textarea name="comment_text" id="comment_text" class="form-control">{{ $comment->comment_text }}</textarea>
                            </div>
                            <button type="submit" form="editCommentForm-{{ $comment->id }}" class="btn btn-primary mt-2">Update</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>


            <!-- Delete Account section -->
            <div class="form-container" id="deleteAccountData" style="display: none;">
                <form class="form" method="POST" action="{{ route('delete_account') }}" onsubmit="return confirmDelete()">
                    @csrf
                    <h4 class="mb-4">Delete Account</h4>
                    <div class="mb-3">
                        <label for="password" class="form-label">Enter Your Password:</label>
                        <input type="password" class="form-control" name="password" id="deleteAccountPassword" oninput="enableDeleteBtn()">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-danger" id="delete-account-btn" disabled>Permanently Delete My Account</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
