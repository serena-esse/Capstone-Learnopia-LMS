<!-- resources/views/courses/show.blade.php -->

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
                <div class="mb-3">
                    @if($course->video_url)
                        <video width="100%" controls>
                            <source src="{{ $course->video_url }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <p>No video available</p>
                    @endif
                </div>
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
                    <ul>
                        @foreach($course->lessons as $lesson)
                            <li class="mb-2">
                                <a href="{{ route('courses.lessons.show', [$course, $lesson]) }}" class="text-blue-500">{{ $lesson->title }}</a>
                            </li>
                        @endforeach
                    </ul>
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
</x-app-layout>
