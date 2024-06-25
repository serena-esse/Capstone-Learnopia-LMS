<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
        @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
        <div class="mb-4">
            <a href="{{ route('courses.create') }}" class="btn btn-light">Create Course</a>
        </div>
        @endif

        @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ $message }}
        </div>
        @endif

        <div class="flex justify-center mb-4">
            <form method="GET" action="{{ route('courses.index') }}" class="flex items-center">
                <input type="text" name="search" placeholder="Search courses..." class="form-input rounded-md shadow-sm mt-1 block w-full">
                <button type="submit" class="ml-2 btn btn-primary">Search</button>
            </form>
        </div>

        @if ($courses->isEmpty())
        <p>There are no courses to display.</p>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($courses as $course)
            <div class="overflow-hidden bg-white shadow-sm rounded-lg">
                @if($course->image)
                <img src="{{ asset('images/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-56 object-cover">
                @endif
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $course->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ $course->description }}</p>
                    <div class="flex justify-between items-center">
                        <p class="text-xs text-gray-500">Start Date: {{ $course->start_date }}</p>
                        <p class="text-xs text-gray-500">End Date: {{ $course->end_date }}</p>
                    </div>
                    <div class="mt-4 flex justify-end space-x-2">
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info btn-sm">View</a>
                        @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        @endif
                        <form action="{{ route('courses.enroll', $course) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Enroll</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>
