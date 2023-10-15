@extends('layouts.app')

@section('content')
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
