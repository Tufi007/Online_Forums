@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form class="form" method="post" action="{{ route('update_answer', ['answer_id' => $answer->id]) }}" enctype="multipart/form-data">
        @csrf
        <div class="form-item mb-3">
            <h2>Edit Answer</h2>
        </div>
        <!-- Answer text field -->
        <div class="form-item mb-3">
            <label for="answer_text" class="form-label">Answer Text:</label>
            <textarea name="answer_text" id="answer_text" class="form-control" cols="30" rows="10">{{ $answer->answer_text }}</textarea>
        </div>

        <!-- Image preview and delete buttons -->
        <div class="mb-3">
            <strong>Images:</strong>
            @if ($answer->image)
            @foreach (json_decode($answer->image) as $imagePath)
            <div class="form-item image-box">
                <img src="{{ asset($imagePath) }}" alt="Answer Image" class="img-fluid">
                <button class="delete-image btn btn-danger mt-3" data-image="{{ $imagePath }}">Delete</button>
            </div>
            @endforeach
            @endif
        </div>

        <!-- New images input -->
        <div class="form-item mb-3">
            <strong>Upload New Images:</strong>
            <input type="file" name="new_images[]" class="form-control" multiple>
        </div>

        <!-- Hidden input to store deleted images -->
        <div class="form-item">
            <input type="hidden" name="deleted_images" id="deletedImages">
        </div>
        <div class="form-item mb-3">
            <label for="reference_links" class="form-label">Reference Links:</label>
            <input type="text" name="reference_links" id="reference_links" class="form-control" value="{{ $answer->reference_links }}">
        </div>

        <div class="form-item mb-3">
            <button type="submit" class="btn btn-primary">Update Answer</button>
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
