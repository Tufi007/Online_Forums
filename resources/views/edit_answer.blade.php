<!-- edit_answer.blade.php -->
@extends('layouts.app')

@section('content')
<div class="form-container">
    <form class="form" method="post" action="{{ route('update_answer', ['answer_id' => $answer->a_id]) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-item">
        <h2>Edit Answer</h2>
        </div>
        <!-- Answer text field -->
        <div class="form-item">
            <label for="answer_text">Answer Text:</label>
            <textarea name="answer_text" id="answer_text" cols="30" rows="10">{{ $answer->answer_text }}</textarea>
        </div>

        <!-- Image preview and delete buttons -->
        <div>
            <strong>Images:</strong>
            @if ($answer->image)
            @foreach (json_decode($answer->image) as $imagePath)
            <div class="form-item image-box">
                <img src="{{ asset($imagePath) }}" alt="Answer Image">
                <button class="delete-image form-btn-alert" data-image="{{ $imagePath }}">Delete</button>
            </div>
            @endforeach
            @endif
        </div>

        <!-- New images input -->
        <div class="form-item">
            <strong>Upload New Images:</strong>
            <input type="file" name="new_images[]" multiple>
        </div>

        <!-- Hidden input to store deleted images -->
        <div class="form-item">
            <input type="hidden" name="deleted_images" id="deletedImages">
        </div>
        <div class="form-item">
            <label for="reference_links">Reference Links</label>
            <input type="text" name="reference_links" id="reference_links" value="{{ $answer->reference_links }}">
        </div>

        <div class="form-item">
            <button type="submit" class="form-btn">Update Answer</button>
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
