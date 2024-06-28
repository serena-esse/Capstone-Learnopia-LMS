<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Barra di ricerca -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="GET" action="{{ route('dashboard') }}">
                        <div class="flex items-center">
                            <input type="text" name="search" placeholder="Search courses..." class="form-input rounded-md shadow-sm mt-1 block w-full">
                            <x-secondary-button type="submit" class="ml-2">Search</x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Elenco dei corsi -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Your Courses') }}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($courses as $course)
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
                                        <p class="text-sm text-gray-500">Progress: {{ number_format($course->progress, 2) }}%</p>
                                    </div>
                                </a>
                                <div class="p-4 border-t border-gray-200 bg-gray-50 text-center">
                                    <a href="{{ route('courses.show', $course->id) }}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded-lg inline-block">
                                        View Course
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Azioni rapide -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                        <div class="p-6 text-gray-900">
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

                    <!-- Paginazione -->
                    <div class="mt-6">
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
