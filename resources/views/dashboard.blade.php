<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Corsi in corso -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Your Courses') }}</h3>
                    <!-- Search bar -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('dashboard') }}">
                            <div class="flex items-center">
                                <input type="text" name="search" placeholder="Search courses..." class="form-input rounded-md shadow-sm mt-1 block w-full">
                                <x-primary-button type="submit" class="ml-2">Search</x-primary-button>
                            </div>
                        </form>
                    </div>

                    <!-- Elenco dei corsi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($courses as $course)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                                <a href="{{ route('courses.show', $course->id) }}" class="block hover:bg-gray-50">
                                    <div class="p-4">
                                        <h5 class="text-lg font-semibold">{{ $course->title }}</h5>
                                        <!-- Display the course image if it exists -->
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
                                <div class="p-4 border-t border-gray-200 bg-gray-50">
                                    <form action="{{ route('courses.enroll', $course) }}" method="POST" class="text-center">
                                        @csrf
                                        <x-primary-button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Enroll in this course</x-primary-button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Azioni rapide -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Quick Actions') }}</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
                            <a href="{{ route('courses.create') }}" class="bg-orange-600 p-4 rounded-lg text-center text-white font-bold hover:bg-orange-500">
                                {{ __('Create New Course') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
