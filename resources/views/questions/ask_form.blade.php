@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h1 class="mb-0">Kindly ask your question</h1>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('submit_question') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Question Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                            <div class="invalid-feedback">
                                Please enter the question title.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Question Description</label>
                            <textarea class="form-control" name="description" id="description" rows="7" required></textarea>
                            <div class="invalid-feedback">
                                Please enter the question description.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label">Images:</label>
                            <div id="imageContainer">
                                <input type="file" class="form-control" name="images[]" accept="image/*">
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="button" id="addImage" class="btn btn-primary">Add More Images</button>
                        </div>
                        <div class="mb-3">
                            <label for="noImages" class="form-label">No Images</label>
                            <input type="checkbox" class="form-check-input" name="noImages" id="noImages">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <select class="form-select" name="subject_id" id="subject">
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="{{ asset('js/ask_form.js') }}"></script>
