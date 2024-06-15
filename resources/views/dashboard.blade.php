<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Corsi in corso -->
            <div class="overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Your Courses') }}</h3>
                    <!-- Elenco dei corsi -->
                    <div class="row">
                        @foreach($courses as $course)
                            <div class="col-md-4 mb-4">
                                <a href="{{ route('courses.show', $course->id) }}" class="text-blue-500">
                                    <div class="card h-100">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $course->title }}</h5>
                                            <!-- Display the course image if it exists -->
                                            @if($course->image)
                                                <img src="{{ asset('images/' . $course->image) }}" alt="{{ $course->title }}" class="img-fluid mb-3">
                                            @endif
                                            <p class="card-text">{{ $course->description }}</p>
                                            <p class="card-text"><small class="text-muted">Start Date: {{ $course->start_date }}</small></p>
                                            <p class="card-text"><small class="text-muted">End Date: {{ $course->end_date }}</small></p>
                                            <div class="mt-auto">
                                                <span>{{ $course->progress }}%</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Azioni rapide -->
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Quick Actions') }}</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a href="{{ route('courses.create') }}" class="dark:bg-gray-700 p-4 rounded-lg text-center">
                            {{ __('Create New Course') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
