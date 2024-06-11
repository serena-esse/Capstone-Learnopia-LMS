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
</x-app-layout>
