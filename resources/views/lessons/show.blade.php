<!-- resources/views/lessons/show.blade.php -->

<x-app-layout>
    <div class="container">
        <h1>Lesson Details</h1>

        <h2>{{ $lesson->title }}</h2>
        <p><strong>Course:</strong> {{ $course->title }}</p>
        <div>
            <strong>Video:</strong>
            @if ($lesson->video_url)
                <div class="video-container">
                    <iframe width="560" height="315" src="{{ $lesson->video_url }}" frameborder="0" allowfullscreen></iframe>
                </div>
            @else
                <p>No video available</p>
            @endif
        </div>
        <p><strong>Content:</strong></p>
        <div>
            {!! nl2br(e($lesson->content)) !!}
        </div>

        <a href="{{ route('courses.lessons.index', $course) }}" class="btn btn-secondary">Back to Lessons</a>
    </div>

    <style>
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
            margin-bottom: 20px;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</x-app-layout>
