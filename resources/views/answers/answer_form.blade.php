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

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h1 class="mb-0 h2">Answer Form</h1>
                </div>
                <div class="card-body">
                    <h2 class="card-title h4">Question: {{ $question->title }}</h2>
                    <h3 class="card-subtitle mb-3 text-muted h5">Description: {{ $question->description }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h1 class="mb-0">Submit Answer</h1>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('submit_answer') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <input type="hidden" name="q_id" value="{{ $question->q_id }}">

                        <div class="mb-3">
                            <label for="answer_text" class="form-label">Answer Text</label>
                            <textarea class="form-control" name="answer_text" id="answer_text" rows="5" required></textarea>
                            <div class="invalid-feedback">
                                Please enter your answer text.
                            </div>
                        </div>

                        <label for="images" class="form-label">Image</label>
                        <div class="mb-3" id="imageContainerAnswer">
                            <input type="file" class="form-control" name="images[]" accept="image/*" multiple>
                        </div>

                        <div class="mb-3">
                            <button type="button" id="addImageAnswer" class="btn btn-primary">Add More Images</button>
                        </div>

                        <div class="mb-3">
                            <label for="reference_links" class="form-label">Reference Links</label>
                            <input type="text" class="form-control" name="reference_links" id="reference_links">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Submit Answer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
