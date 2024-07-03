<x-app-layout>
    <div class="container mt-5">
        <h1 class="mb-4">Create New Lesson for {{ $course->title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('courses.lessons.store', $course) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="video_url" class="form-label">Video URL</label>
                <input type="url" name="video_url" id="video_url" class="form-control" placeholder="Enter the video URL">
            </div>
            <div class="form-group mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter the lesson title" required>
            </div>
            <div class="form-group mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" class="form-control" rows="5" placeholder="Enter the lesson content" required></textarea>
            </div>
            <x-primary-button type="submit" class="btn">Save Lesson</x-primary-button>
        </form>
    </div>
</x-app-layout>
