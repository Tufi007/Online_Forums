@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Subject Details</h1>
    <div class="card">
        <div class="card-body">
            <p class="card-text"><strong>ID:</strong> {{ $subject->id }}</p>
            <h5 class="card-title">{{ $subject->title }}</h5>
            <p class="card-text">{{ $subject->description }}</p>
            <p class="card-text"><strong>Date and Time:</strong> {{ $subject->date_time }}</p>
            <p class="card-text"><strong>Subject Code:</strong> {{ $subject->subject_code }}</p>
            <a href="{{ route('subject-page') }}" class="btn btn-primary">Back to Subjects</a>

            @if (auth()->user()->admin->is_admin === 1 )
            <button class="btn btn-primary" id="editButton">Edit Subject</button>
            <div class="mt-4" id="editForm" style="display: none;">
                <form action="{{ route('subjects.edit', ['subject' => $subject->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-4">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $subject->title ? $subject->title : '' }}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control">{{ $subject->description ? $subject->description : '' }}</textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="subject_code">Subject Code</label>
                        <input type="text" name="subject_code" class="form-control" value="{{ $subject->subject_code ? $subject->subject_code : '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Save Changes</button>
                </form>

            </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.getElementById('editButton').addEventListener('click', function() {
        var editForm = document.getElementById('editForm');
        if (editForm.style.display === 'block' || editForm.style.display === '') {
            editForm.style.display = 'none';
        } else {
            editForm.style.display = 'block';
        }
    });
</script>

@endsection
