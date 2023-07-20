@extends('layouts.app')

@section('content')
<h1>This is the form page for asking questions</h1>
<form action="{{ route('submit_question') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="7"></textarea>
    </div>
    <label for="images">Images:</label>
    <div id="imageContainer">
        <input type="file" name="images[]" accept="image/*">
    </div>
    <button type="button" id="addImage">Add More Images</button>
    <div>
        <input type="checkbox" name="noImages" id="noImages">
        <label for="no_images">No Images</label>
    </div>
    <div>
    <label for="subject">Subject</label>
    <select name="subject_id" id="subject">
        @foreach($subjects as $subject)
            <option value="{{ $subject->s_id }}">{{ $subject->title }}</option>
        @endforeach
    </select>
</div>

    <div>
        <button type="submit">Submit</button>
    </div>
</form>

@endsection

<script src="{{ asset('js/ask_form.js') }}"></script>
