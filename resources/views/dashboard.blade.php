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
                    <row>
                        @foreach($courses as $course)
                            <div class="col-md-4 mb-4">
                                <a href="{{ route('courses.show', $course->id) }}" class="text-blue-500">
                                    {{ $course->title }}
                                    <div class="card-body d-flex flex-column">
                                                                               
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
                                        <p class="card-text">{{ $course->description }}</p>
                                        <p class="card-text"><small class="text-muted">Start Date: {{ $course->start_date }}</small></p>
                                        <p class="card-text"><small class="text-muted">End Date: {{ $course->end_date }}</small></p>
                                        
                                    </div>
                                </a> - {{ $course->progress }}%
                            </div>
                        @endforeach
                    </row>
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
