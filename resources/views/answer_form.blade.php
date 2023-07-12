@extends('layouts.app')

@section('content')
    <h1>Answer Form</h1>
    <h2>Question: {{ $question->title }}</h2>
    <h3>Description: {{ $question->description }}</h3>

    <form action="{{ route('submit_answer') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="q_id" value="{{ $question->q_id }}">

        <div>
            <label for="answer_text">Answer Text</label>
            <textarea name="answer_text" id="answer_text" rows="5" required></textarea>
        </div>

        <label for="images">Image</label>
        <div id="imageContainerAnswer">
             <input type="file" name="images[]" accept="image/*" multiple>
        </div>

        <button type="button" id="addImageAnswer">Add More Images</button>

        <div>
            <label for="reference_links">Reference Links</label>
            <input type="text" name="reference_links" id="reference_links">
        </div>

        <button type="submit">Submit Answer</button>
    </form>
@endsection


