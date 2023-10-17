@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form class="form" method="post" action="{{ route('update_question', ['q_id' => $question->id]) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-item mb-3">
            <h2>Edit Question</h2>
        </div>
        <!-- Title -->
        <div class="form-item mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $question->title }}">
        </div>

        <!-- Description -->
        <div class="form-item mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea id="description" name="description" class="form-control">{{ $question->description }}</textarea>
        </div>

        <!-- Images -->
        <div class="mb-3">
            <strong>Images:</strong>
            <!-- Show existing images -->
            @if ($question->image)
            <div class="existing-images">
                @foreach (json_decode($question->image) as $imagePath)
                <div class="form-item image-box mb-3">
                    <img src="{{ asset($imagePath) }}" alt="Question Image" class="img-fluid">
                    <button type="button" class="delete-image btn btn-danger mt-3" data-image="{{ $imagePath }}">Delete</button>
                </div>
                @endforeach
            </div>
            @endif
            <!-- Allow users to delete existing images -->
            <input type="hidden" id="deletedImages" name="deleted_images" value="">
            <!-- Allow users to upload new images -->
            <div class="form-item mb-3">
                <label for="images" class="form-label">Images:</label>
                <div class="form-item">
                    <input type="file" name="new_images[]" class="form-control" multiple>
                </div>
            </div>
            <div class="form-item mb-3">
                <button type="button" id="addImageEditQ" class="btn btn-primary">Add More Images</button>
            </div>
        </div>

        <div class="form-item mb-3">
            <label for="subject" class="form-label">Subject:</label>
            <select name="subject_id" id="subject" class="form-select">
                @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" @if($question->subject_id == $subject->id) selected @endif>{{ $subject->title }}</option>
                @endforeach
            </select>
        </div>
        <!-- Submit button -->
        <div class="form-item mb-3">
            <button type="submit" class="btn btn-primary">Update Question</button>
        </div>
    </form>
</div>

<script>
    // Delete image when the "Delete" button is clicked
    document.querySelectorAll('.delete-image').forEach(function(button) {
        button.addEventListener('click', function() {
            var imagePath = button.getAttribute('data-image');
            var deletedImagesInput = document.getElementById('deletedImages');
            var deletedImages = deletedImagesInput.value ? JSON.parse(deletedImagesInput.value) : [];
            deletedImages.push(imagePath);
            deletedImagesInput.value = JSON.stringify(deletedImages);
            button.parentElement.remove();
        });
    });
</script>
@endsection

<script src="{{ asset('js/edit_question.js') }}"></script>
