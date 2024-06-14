<!-- resources/views/lessons/edit.blade.php -->

<x-app-layout>
    <div class="container">
        <h1>Edit Lesson for {{ $course->title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('courses.lessons.update', [$course, $lesson]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $lesson->title) }}">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5">{{ old('content', $lesson->content) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Lesson</button>
        </form>
    </div>
</x-app-layout>
