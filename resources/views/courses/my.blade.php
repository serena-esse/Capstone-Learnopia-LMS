<!-- resources/views/courses/my.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Your Enrolled Courses') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($courses as $course)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                                <a href="{{ route('courses.show', $course->id) }}" class="block hover:bg-gray-50">
                                    <div class="p-4">
                                        <h5 class="text-lg font-semibold">{{ $course->title }}</h5>
                                        @if($course->image)
                                            <img src="{{ asset('images/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-48 object-cover mt-2 mb-4 rounded-lg">
                                        @endif
                                        <p class="text-gray-700">{{ $course->description }}</p>
                                        <p class="text-sm text-gray-500 mt-2">Start Date: {{ $course->start_date }}</p>
                                        <p class="text-sm text-gray-500">End Date: {{ $course->end_date }}</p>
                                        <div class="mt-4">
                                            <span class="text-indigo-600 font-semibold">{{ $course->progress }}%</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="text-gray-500">{{ __('You are not enrolled in any courses.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
