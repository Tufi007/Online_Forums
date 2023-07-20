<!-- edit_question.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>Edit Question</h2>
    <form method="post" action="{{ route('update_question', ['q_id' => $question->q_id]) }}" enctype="multipart/form-data">
        @csrf
        <!-- Title -->
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ $question->title }}">
        </div>

        <!-- Description -->
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ $question->description }}</textarea>
        </div>

        <!-- Other columns from the questions table -->
        <!-- Add other fields here -->

        <!-- Images -->
        <div>
            <strong>Images:</strong>
            <!-- Show existing images -->
            @if ($question->image)
                <div class="existing-images">
                    @foreach (json_decode($question->image) as $imagePath)
                        <div>
                            <img src="{{ asset($imagePath) }}" alt="Question Image">
                            <button type="button" class="delete-image" data-image="{{ $imagePath }}">Delete</button>
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- Allow users to delete existing images -->
            <input type="hidden" id="deletedImages" name="deleted_images" value="">
            <!-- Allow users to upload new images -->
            <input type="file" name="new_images[]" multiple>
        </div>

        <div>
        <label for="subject">Subject:</label>
        <select name="subject_id" id="subject">
            @foreach($subjects as $subject)
                <option value="{{ $subject->s_id }}" @if($question->subject_id == $subject->s_id) selected @endif>{{ $subject->title }}</option>
            @endforeach
        </select>
        </div>
        <!-- Submit button -->
        <button type="submit">Update Question</button>
    </form>

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
