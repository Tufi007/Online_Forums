@extends('layouts.app')

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<h1>Answer Form</h1>
<h2>Question: {{ $question->title }}</h2>
<h3>Description: {{ $question->description }}</h3>

<div class="form-container">
    <form class="form" action="{{ route('submit_answer') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="q_id" value="{{ $question->q_id }}">

        <div class="form-item">
            <label for="answer_text">Answer Text</label>
            <textarea name="answer_text" id="answer_text" rows="5" required></textarea>
        </div>

        <label for="images">Image</label>
        <div class="form-item" id="imageContainerAnswer">
            <input type="file" name="images[]" accept="image/*" multiple>
        </div>

        <div class="form-item">
            <button type="button" id="addImageAnswer" class="form-btn">Add More Images</button>
        </div>

        <div class="form-item">
            <label for="reference_links">Reference Links</label>
            <input type="text" name="reference_links" id="reference_links">
        </div>

        <div class="form-item">
            <button type="submit" class="form-btn">Submit Answer</button>
        </div>
    </form>
</div>
@endsection
