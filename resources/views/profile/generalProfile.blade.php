@extends('layouts.app')

@section('content')
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
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
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Profile</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if(isset($user->profiles->profile_picture))
                            <img src="{{ asset($user->profiles->profile_picture) }}" alt="Profile Picture" class="img-fluid">
                            @else
                            <img src="{{ asset('profilePictures/default-image.webp') }}" alt="Default Profile Picture" class="img-fluid">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h2>{{ $user->name }}</h2>
                            <p>Email: {{ $user->email }}</p>
                            <p>Username: {{ $user->username }}</p>
                            <hr>

                            <div class="mb-4">
                                <h4>Personal Information</h4>
                                <ul class="list-unstyled">
                                    <li><strong>Date of Birth:</strong> {{ $user->profiles->date_of_birth ?? 'N/A' }}</li>
                                    <li><strong>Street Address:</strong> {{ $user->profiles->street_address ?? 'N/A' }}</li>
                                    <li><strong>State/City:</strong> {{ $user->profiles->state_city ?? 'N/A' }}</li>
                                    <li><strong>Country:</strong> {{ $user->profiles->country ?? 'N/A' }}</li>
                                </ul>
                            </div>

                            <div class="mb-4">
                                <h4>Education and Work</h4>
                                <ul class="list-unstyled">
                                    <li><strong>Academic Qualification:</strong> {{ $user->profiles->academic_qualification ?? 'N/A' }}</li>
                                    <li><strong>Work Experience:</strong> {{ $user->profiles->work_experience ?? 'N/A' }}</li>
                                </ul>
                            </div>

                            <div class="mb-4">
                                <h4>About Me</h4>
                                <p>{{ $user->profiles->about_you ?? 'N/A' }}</p>
                            </div>

                            <h4>Activity</h4>
                            <ul class="list-unstyled">
                                <li><strong>Questions Asked:</strong> {{ $user->questions->count() }}</li>
                                <li><strong>Answers Given:</strong> {{ $user->answers->count() }}</li>
                                @if ($user->isAdmin())
                                <li><strong>User is an admin.</strong></li>
                                @else
                                <li><strong>User is not an admin.</strong></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <!-- Add this button within the existing markup -->
                    @if(auth()->user()->isAdmin() && !$user->isAdmin())
                    <button class="btn btn-primary" onclick="toggleMakeAdminModal()">Make Administrator</button>
                    @endif


                    <!-- The rest of your existing content goes here -->

                    <div id="makeAdminModal" class="custom-modal" style="display: none;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="makeAdminModalLabel">Make Administrator</h5>
                                <button onclick="toggleMakeAdminModal()" type="button" class="btn btn-secondary" id="closeModal">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div>
                            <form method="POST" action="{{ route('admin.make.admin', ['user_id' => $user->id]) }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="admin_password">Enter Your Password</label>
                                        <input type="password" class="form-control" id="admin_password" name="admin_password" required>
                                    </div>
                                </div>
                                <div class="modal-footer mt-2">
                                    <button onclick="toggleMakeAdminModal()" type="button" id="closeModal" class="btn btn-secondary mx-2">Close</button>
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleMakeAdminModal() {
        var modal = document.getElementById("makeAdminModal");
        var currentDisplayStyle = modal.style.display;

        if (currentDisplayStyle === "block") {
            modal.style.display = "none"; // Hide the modal
        } else {
            modal.style.display = "block"; // Show the modal
        }
    }
</script>

@endsection
