<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Your Enrolled Courses') }}</h3>
                    @if($courses->isEmpty())
                        <p>No courses found.</p>
                    @else
                        <ul>
                            @foreach($courses as $course)
                                <li class="mb-2">
                                    <a href="{{ route('courses.show', $course) }}" class="text-blue-500">{{ $course->title }}</a>
                                </li>
                            @endforeach
                        </ul>

                        {{ $courses->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
