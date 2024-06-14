<x-app-layout>
    <div class="container">
        <h1>Edit Lesson for {{ $lesson->course->title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('lessons.update', $lesson) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="course_id">Course</label>
                <select name="course_id" id="course_id" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $course->id == $lesson->course_id ? 'selected' : '' }}>{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="video_url">Video URL</label>
                <input type="url" name="video_url" id="video_url" value="{{ $lesson->video_url }}">
            </div>
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $lesson->title }}" required>
            </div>
            <div>
                <label for="content">Content</label>
                <textarea name="content" id="content" required>{{ $lesson->content }}</textarea>
            </div>
            <button type="submit">Update Lesson</button>
        </form>
    </div>
</x-app-layout>
