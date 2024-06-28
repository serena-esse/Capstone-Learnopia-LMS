// resources/views/files/upload.blade.php

<x-app-layout>

@section('content')
<div class="container">
    <h1>Upload File for Lesson: {{ $lesson->title }}</h1>
    <form action="{{ route('courses.lessons.files.upload', ['course' => $lesson->course_id, 'lesson' => $lesson->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Choose File:</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
</x-app-layout>