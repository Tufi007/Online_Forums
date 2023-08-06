@extends('layouts.app')

@section('content')
<div class="form-container">
    <form class="form" action="{{ route('submit_question') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-item">
            <h1>Kindly ask your question</h1>
        </div>
        <div class="form-item">
            <label for="title">Question Title</label>
            <input type="text" name="title" id="title">
        </div>
        <div class="form-item">
            <label for="description">Question Description</label>
            <textarea name="description" id="description" rows="7"></textarea>
        </div>
        <div class="form-item">
            <label for="images">Images:</label>
            <div id="imageContainer">
                <input type="file" name="images[]" accept="image/*">
            </div>
        </div>
        <div class="form-item">
        <button type="button" id="addImage" class="form-btn">Add More Images</button>
        </div>
        <div class="form-item">
            <label for="no_images">No Images</label>
            <input type="checkbox" name="noImages" id="noImages">
        </div>
        <div class="form-item">
            <label for="subject">Subject</label>
            <select name="subject_id" id="subject">
                @foreach($subjects as $subject)
                <option value="{{ $subject->s_id }}">{{ $subject->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-item">
            <button type="submit" class="form-btn">Submit</button>
        </div>
    </form>
</div>

@endsection

<script src="{{ asset('js/ask_form.js') }}"></script>
