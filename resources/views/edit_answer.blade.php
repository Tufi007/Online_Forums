<!-- edit_answer.blade.php -->
@extends('layouts.app')

@section('content')
    <h2>Edit Answer</h2>
    <form method="post" action="{{ route('update_answer', ['answer_id' => $answer->a_id]) }}" enctype="multipart/form-data">
        @csrf
        <!-- Answer text field -->
        <div>
            <label for="answer_text">Answer Text:</label>
            <textarea name="answer_text" id="answer_text" cols="30" rows="10">{{ $answer->answer_text }}</textarea>
        </div>

        <!-- Image preview and delete buttons -->
        <div>
            <strong>Images:</strong>
            @if ($answer->image)
                @foreach (json_decode($answer->image) as $imagePath)
                    <div>
                        <img src="{{ asset($imagePath) }}" alt="Answer Image">
                        <button class="delete-image" data-image="{{ $imagePath }}">Delete</button>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- New images input -->
        <div>
            <strong>Upload New Images:</strong>
            <input type="file" name="new_images[]" multiple>
        </div>

        <!-- Hidden input to store deleted images -->
        <input type="hidden" name="deleted_images" id="deletedImages">
        <div>
            <label for="reference_links">Reference Links</label>
            <input type="text" name="reference_links" id="reference_links" value="{{ $answer->reference_links }}">
        </div>

        <button type="submit">Update Answer</button>
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
