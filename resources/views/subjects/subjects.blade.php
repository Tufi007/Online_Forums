@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Subjects</h1>
    @if($subjects->isEmpty())
    <p>There are no subjects yet.</p>
    @else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
            <tr>
                <td>{{ $subject->id }}</td>
                <td>{{ $subject->title }}</td>
                <td>
                    <a href="{{ route('subject.view', ['subject_id' => $subject->id]) }}" class="btn btn-primary">View Subject</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <button id="addSubjectButton" class="btn btn-success mt-3">Add Subject</button>

    <div id="addSubjectForm" style="display: none;">
        <h2>Add New Subject</h2>
        <form action="{{ route('add.subject') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="subject_code" class="form-label">Subject Code</label>
                <input type="text" class="form-control" name="subject_code" id="subject_code" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('addSubjectButton').addEventListener('click', function() {
        var form = document.getElementById('addSubjectForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    });
</script>
</div>
@endsection
