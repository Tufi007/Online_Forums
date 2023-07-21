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
            <!-- User Data Form -->
            <h2>Edit User Data</h2>
            <form method="post" action="{{ route('update_user_data') }}">
                @csrf
                <label for="name">Name:</label>
                <input type="text" name="name" value="{{ $user->name }}" required>
                <br>
                <label for="email">Email:</label>
                <input type="email" name="email" value="{{ $user->email }}" required disabled>
                <br>
                <label for="username">Username:</label>
                <input type="text" name="username" value="{{ $user->username }}" required disabled>
                <br>
                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" value="{{ $user->phone_number }}" required>
                <br>
                <label for="alternate_phone_number">Phone Number:</label>
                <input type="text" name="alternate_phone_number" value="{{ $user->alternate_phone_number }}" required>
                <br>
                <!-- Add other user fields here -->

                <button type="submit">Update User Data</button>
            </form>

            <!-- Profile Data Form -->
            <h2>Edit Profile Data</h2>
            @if (isset($user->profiles))
            <form method="post" action="{{ route('update_profile_data') }}" enctype="multipart/form-data">
                @csrf
                @if ($user->profiles && $user->profiles->profile_picture)
                <img src="{{ asset($user->profiles->profile_picture) }}" alt="Profile Picture" width="100">
                @endif
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture">
                <br>

                <label for="street_address">Street Address</label>
                <input type="text" name="street_address" value="{{ $user->profiles->street_address }}">
                <br>

                <label for="state_city">State and City</label>
                <input type="text" name="state_city" value="{{ $user->profiles->state_city }}">
                <br>

                <label for="country">Country</label>
                <input type="text" name="country" value="{{ $user->profiles->country }}">
                <br>

                <label for="date_of_birth">Date of birth</label>
                <input type="date" name="date_of_birth" value="{{ $user->profiles->date_of_birth }}">
                <br>

                <label for="academic_qualification">Academic Qualification</label>
                <input type="text" name="academic_qualification" value="{{ $user->profiles->academic_qualification }}">
                <br>

                <label for="work_experience">Work Experience</label>
                <input type="textarea" rows="5" name="work_experience" value="{{ $user->profiles->work_experience }}">
                <br>

                <label for="about_you">About You</label>
                <input type="textarea" rows="5" name="about_you" value="{{ $user->profiles->about_you }}">
                <br>


                <button type="submit">Update Profile Data</button>
            </form>
            @else
            <p>No profile data found. Create a profile.</p>
            <form method="post" action="{{ route('create_profile') }}" enctype="multipart/form-data">
                @csrf
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" name="profile_picture">
                <br>

                <label for="street_address">Street Address</label>
                <input type="text" name="street_address">
                <br>

                <label for="state_city">State and City</label>
                <input type="text" name="state_city">
                <br>

                <label for="country">Country</label>
                <input type="text" name="country">
                <br>

                <label for="date_of_birth">Date of birth</label>
                <input type="date" name="date_of_birth">
                <br>

                <label for="academic_qualification">Academic Qualification</label>
                <input type="text" name="academic_qualification">
                <br>

                <label for="work_experience">Work Experience</label>
                <input type="textarea" rows="5" name="work_experience">
                <br>

                <label for="about_you">About You</label>
                <input type="textarea" rows="5" name="about_you">
                <br>
                <br>

                <button type="submit">Create Profile</button>
            </form>
            @endif
        </div>

        <!-- My questions data -->
        <div id="questionsData" style="display: none;">
            <h2>This is the questions data</h2>
            <ul>
                @foreach ($user->questions as $question)
                <li>{{ $question->title }} <a href="{{ route('edit_question', ['question_id' => $question->q_id]) }}">Edit</a></li>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- My answers data -->
        <div id="answersData" style="display: none;">
            <h2>This is the answers data</h2>
            <ul>
                @foreach ($user->answers as $answer)
                <li>{{ $answer->answer_text }} <a href="{{ route('edit_answer', ['answer_id' => $answer->a_id]) }}">Edit</a> </li>
                @endforeach
            </ul>
        </div>

        <!-- My comments data -->
        <div id="commentsData" style="display: none;">
            <h2>This is the comments data</h2>
            <ul>
                @foreach ($user->comments as $comment)
                <li id="comment-{{ $comment->id }}">{{ $comment->comment_text }}</li>
                <button class="edit-comment-button" onclick="openEditPopup('{{ $comment->id }}')" data-comment-id="{{ $comment->id }}" id="edit-comment-btn-{{ $comment->id }}">Edit</button>
                @endforeach

            </ul>
        </div>
        <!-- Edit Comment Popup -->
        <div id="editCommentModal" style="display: none;">
            <h2>Edit Comment</h2>
            <textarea id="editCommentText"></textarea>
            <button onclick="updateComment()">Save Changes</button>
            <button onclick="closeEditPopup()">Cancel</button>
        </div>
    </main>
</div>

<script>
    function openEditPopup(commentId) {
        const commentText = document.getElementById(`comment-${commentId}`).innerText;
        document.getElementById('editCommentText').value = commentText;
        document.getElementById('editCommentModal').style.display = 'block';
    }

    function closeEditPopup() {
        document.getElementById('editCommentModal').style.display = 'none';
    }

    function updateComment() {
        const editCommentBtn = document.getElementById(`edit-comment-btn-{{$comment->id}}`);
        const commentId = editCommentBtn.getAttribute("data-comment-id");
        const editedComment = document.getElementById('editCommentText').value;

        // Send the update request using AJAX
        fetch(`/update_comment/${commentId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Replace with the actual CSRF token
                },
                body: JSON.stringify({
                    comment_text: editedComment
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Assuming the server responds with the updated comment data
                // Update the comment text in the view
                document.getElementById(`comment-${commentId}`).innerText = data.comment_text;

                // Close the edit comment popup
                closeEditPopup();
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
            });
    }
</script>
@endsection
