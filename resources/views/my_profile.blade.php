@extends('layouts.app')

@section('content')
<div class="content-row">
    <aside class="content-item">
        <h4>Profile Settings</h4>
        <ul>
            <li><button onclick="showData('profile')">Edit/Update Profile</button></li>
            <li><button onclick="showData('changePassword')">Change Password</button></li>
            <li><button onclick="showData('questions')">My Questions</button></li>
            <li><button onclick="showData('answers')">My Answers</button></li>
            <li><button onclick="showData('comments')">My Comments</button></li>
            <li><button onclick="showData('deleteAccount')">Delete My Account</button></li>
        </ul>
    </aside>
    <main class="content-item">
        <!-- Profile data -->
        <div class="form-container" id="profileData" style="display: none;">
            <!-- User Data Form -->
            <form class="form" method="post" action="{{ route('update_user_data') }}">
                @csrf
                <div class="form-item">
                    <h2>Edit User Data</h2>
                </div>
                <div class="form-item">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="{{ $user->name }}" required>
                </div>
                <div class="form-item">
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="{{ $user->email }}" required disabled>
                </div>
                <div class="form-item">
                    <label for="username">Username:</label>
                    <input type="text" name="username" value="{{ $user->username }}" required disabled>
                </div>
                <div class="form-item">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" value="{{ $user->phone_number }}" required>
                </div>
                <div class="form-item">
                    <label for="alternate_phone_number">Phone Number:</label>
                    <input type="text" name="alternate_phone_number" value="{{ $user->alternate_phone_number }}" required>
                </div>
                <div class="form-item">
                    <button class="form-btn" type="submit">Update User Data</button>
                </div>
            </form>

            <!-- Profile Data Form -->

            @if (isset($user->profiles))
            <div class="form-container">
                <form class="form" method="post" action="{{ route('update_profile_data') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-item">
                        <h2>Edit Profile Data</h2>
                    </div>
                    @if ($user->profiles && $user->profiles->profile_picture)
                    <div class="form-item">
                        <img src="{{ asset($user->profiles->profile_picture) }}" alt="Profile Picture" width="100">
                    </div>
                    @endif
                    <div class="form-item">
                        <label for="profile_picture">Profile Picture:</label>
                        <input type="file" name="profile_picture">
                    </div>


                    <div class="form-item">
                        <label for="street_address">Street Address</label>
                        <input type="text" name="street_address" value="{{ $user->profiles->street_address }}">
                    </div>

                    <div class="form-item">
                        <label for="state_city">State and City</label>
                        <input type="text" name="state_city" value="{{ $user->profiles->state_city }}">
                    </div>




                    <div class="form-item">
                        <label for="country">Country</label>
                        <input type="text" name="country" value="{{ $user->profiles->country }}">
                    </div>


                    <div class="form-item">
                        <label for="date_of_birth">Date of birth</label>
                        <input type="date" name="date_of_birth" value="{{ $user->profiles->date_of_birth }}">
                    </div>


                    <div class="form-item">
                        <label for="academic_qualification">Academic Qualification</label>
                        <input type="text" name="academic_qualification" value="{{ $user->profiles->academic_qualification }}">
                    </div>


                    <div class="form-item">
                        <label for="work_experience">Work Experience</label>
                        <input type="textarea" rows="5" name="work_experience" value="{{ $user->profiles->work_experience }}">
                    </div>


                    <div class="form-item">
                        <label for="about_you">About You</label>
                        <input type="textarea" rows="5" name="about_you" value="{{ $user->profiles->about_you }}">

                    </div>


                    <div class="form-item">
                        <button class="form-btn" type="submit">Update Profile Data</button>
                    </div>
                </form>
            </div>

            @else
            <div class="form-container">
                <form method="post" action="{{ route('create_profile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-item">
                        <p>No profile data found. Create a profile.</p>
                    </div>
                    <div class="form-item">
                        <label for="profile_picture">Profile Picture:</label>
                        <input type="file" name="profile_picture">
                    </div>
                    <div class="form-item">
                        <label for="street_address">Street Address</label>
                        <input type="text" name="street_address">
                    </div>
                    <div class="form-item">
                        <label for="state_city">State and City</label>
                        <input type="text" name="state_city">
                    </div>
                    <div class="form-item">
                        <label for="country">Country</label>
                        <input type="text" name="country">
                    </div>
                    <div class="form-item">
                        <label for="date_of_birth">Date of birth</label>
                        <input type="date" name="date_of_birth">
                    </div>
                    <div class="form-item">
                        <label for="academic_qualification">Academic Qualification</label>
                        <input type="text" name="academic_qualification">
                    </div>
                    <div class="form-item">

                        <label for="work_experience">Work Experience</label>
                        <input type="textarea" rows="5" name="work_experience">
                    </div>
                    <div class="form-item">
                        <label for="about_you">About You</label>
                        <input type="textarea" rows="5" name="about_you">
                    </div>
                    <div class="form-item">
                        <button class="form-btn" type="submit">Create Profile</button>
                    </div>
                </form>
            </div>

            @endif
        </div>

        <!-- Change Password -->
        <div class="form-container" id="changePasswordData" style="display: none;">
            <form class="form" method="POST" action="{{ route('change_password') }}" onsubmit="return validatePassword()">
                @csrf
                <div class="form-item">
                <h4>Change Password</h4>
                </div>
                <div  class="form-item">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password">
                </div  class="form-item">
                <div  class="form-item">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password">
                </div>
                <div  class="form-item">
                    <label for="confirm_new_password">Confirm New Password</label>
                    <input type="password" id="confirm_new_password" name="confirm_new_password">
                </div>
                <div  class="form-item">
                    <button class="form-btn" type="submit">Change Password</button>
                </div>
            </form>
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
                @endforeach

            </ul>
        </div>
        <!-- Edit Comment Popup -->
        <div class="form-container" id="editCommentModal" style="display: none;">
            <div class="form">
                <div class="form-item">
                    <h2>Edit Comment</h2>
                </div>
                <div class="form-item">

                    <textarea id="editCommentText"></textarea>
                </div>
                <div class="form-item">
                    <button class="form-btn" onclick="updateComment()">Save Changes</button>
                </div>
                <div class="form-item">
                    <button class="form-btn-alert" onclick="closeEditPopup()">Cancel</button>
                </div>
            </div>
        </div>

        <!-- Delete Account section -->
        <div class="form-container" id="deleteAccountData" style="display: none;">
            <form class="form" method="POST" action="{{ route('delete_account') }}" onsubmit="return confirmDelete()">
                @csrf
                <div class="form-item">
                    <h4>Delete Account</h4>
                </div>
                <div class="form-item">
                    <label for="password">Enter Your Password:</label>
                    <input type="password" name="password" id="deleteAccountPassword" oninput="enableDeleteBtn()">
                </div>
                <div class="form-item">
                    <button type="submit" class="form-btn-alert" id="delete-account-btn" disabled>Permanently Delete My Account</button>
                </div>
            </form>

        </div>
    </main>
</div>


@endsection
