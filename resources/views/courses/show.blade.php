<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Course Details
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="overflow-hidden shadow sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mb-4">
                    <p><strong>{{ $course->title }}</strong></p>
                </div>
                @if ($course->image)
                <div>
                    <img src="{{ asset('images/' . $course->image) }}" alt="{{ $course->title }}" width="600">
                </div>
            @endif
            
                <div class="mb-4">
                    <p><strong>{{ $course->description }}</strong></p>
                </div>
                <div class="mb-4">
                    <p><strong>Start Date:</strong> {{ $course->start_date }}</p>
                </div>
                <div class="mb-4">
                    <p><strong>End Date:</strong> {{ $course->end_date }}</p>
                </div>
                <a href="{{ route('courses.index') }}" class="btn btn-primary">Back to Courses</a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="overflow-hidden shadow sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="font-semibold text-lg text-gray-800 leading-tight">Lessons</h3>
                <a href="{{ route('courses.lessons.create', $course) }}" class="btn btn-primary mb-3">Add Lesson</a>
                @if($course->lessons->isEmpty())
                    <p>No lessons available.</p>
                @else
                    <div class="row">
                        @foreach($course->lessons as $lesson)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body d-flex flex-column">
                                        <a href="{{ route('courses.lessons.show', [$course, $lesson]) }}" class="text-blue-500">{{ $lesson->title }}</a>
                                        @if ($lesson->video_url)
                                            <div class="video-container">
                                                <iframe width="560" height="315" src="{{ $lesson->video_url }}" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        @else
                                            <p>No video available</p>
                                        @endif
                                        <div>
                                            {!! nl2br(e($lesson->content)) !!}
                                        </div>
                                        <div class="mt-auto">
                                            <a href="{{ route('courses.lessons.show', [$course, $lesson]) }}" class="btn btn-warning btn-sm">View</a>
                                            <a href="{{ route('courses.lessons.edit', [$course, $lesson]) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('courses.lessons.destroy', [$course, $lesson]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="overflow-hidden shadow sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="font-semibold text-lg text-gray-800 leading-tight">Quizzes</h3>
                <a href="{{ route('courses.quizzes.create', $course) }}" class="btn btn-primary mb-3">Add Quiz</a>
                @if($course->quizzes->isEmpty())
                    <p>No quizzes available.</p>
                @else
                    <ul>
                        @foreach($course->quizzes as $quiz)
                            <li class="mb-2">
                                <a href="{{ route('courses.quizzes.show', [$course, $quiz]) }}" class="text-blue-500">{{ $quiz->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <style>
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
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
