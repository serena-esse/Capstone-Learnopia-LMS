<!-- resources/views/lessons/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lesson') }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="card-title">{{ $lesson->title }}</h1>
                <h2 class="card-subtitle mb-3 text-muted">{{ $course->title }}</h2>

                <div class="mb-4">
                    <h4>Video</h4>
                    @if ($lesson->video_url)
                        <div class="video-container">
                            <iframe width="560" height="315" src="{{ $lesson->video_url }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    @else
                        <p class="text-muted">No video available</p>
                    @endif
                </div>

                <div class="mb-4">
                    <h4>Content</h4>
                    <div>{!! nl2br(e($lesson->content)) !!}</div>
                </div>

                <div class="mb-4">
                    <h4>Files</h4>
                    <ul class="list-group">
                        @foreach($lesson->files as $file)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('courses.lessons.files.download', ['course' => $lesson->course_id, 'lesson' => $lesson->id, 'file' => $file->id]) }}">
                                    {{ $file->filename }}
                                </a>
                                <span class="badge bg-primary rounded-pill">{{ $file->created_at->format('d/m/Y') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
                    <div class="mb-4">
                        <h4>Upload File for Lesson</h4>
                        <form action="{{ route('courses.lessons.files.upload', ['course' => $lesson->course_id, 'lesson' => $lesson->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file" class="form-label">Choose File:</label>
                                <input type="file" name="file" id="file" class="form-control">
                            </div>
                            <x-primary-button type="submit" class="btn btn-primary">Upload</x-primary-button >
                        </form>
                    </div>
                @endif

                <a href="{{ route('courses.lessons.index', $lesson->course_id) }}" class="btn btn-secondary">Back to Lessons</a>
            </div>
        </div>
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
        .card {
            margin-top: 20px;
        }
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</x-app-layout>
