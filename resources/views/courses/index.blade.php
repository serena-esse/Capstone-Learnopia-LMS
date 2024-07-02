<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5 bg-fef7ed rounded-lg shadow-lg p-6">
        @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
        <x-primary-button class="mb-4">
            <a href="{{ route('courses.create') }}" class="bg-e57e5b hover:bg-dc6c49 text-white font-bold py-2 px-4 rounded-lg inline-block">Create Course</a>
        </x-primary-button>
        @endif

        @if ($message = Session::get('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-3" role="alert">
            {{ $message }}
        </div>
        @endif

        <div class="flex justify-center mb-4">
            <form method="GET" action="{{ route('courses.index') }}" class="flex items-center">
                <input type="text" name="search" placeholder="Search courses..." class="form-input rounded-md shadow-sm mt-1 block w-full">
                <x-secondary-button type="submit" class="ml-2">Search</x-secondary-button>
            </form>
        </div>

        @if ($courses->isEmpty())
        <p class="text-center text-gray-600">There are no courses to display.</p>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($courses as $course)
            <div class="overflow-hidden bg-deedda rounded-lg shadow-md flex flex-col">
                @if($course->image)
                <img src="{{ asset('images/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-56 object-cover rounded-t-lg">
                @endif
                <div class="p-4 bg-white rounded-b-lg flex-grow flex flex-col">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $course->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ $course->description }}</p>
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-xs text-gray-500">Start Date: {{ $course->start_date }}</p>
                        <p class="text-xs text-gray-500">End Date: {{ $course->end_date }}</p>
                    </div>
                    <div class="mt-auto flex justify-center space-x-2">
                        <x-primary-button type="button" onclick="window.location.href='{{ route('courses.show', $course->id) }}'">
                            <span class="text-sm">View</span>
                        </x-primary-button>
                        @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
                        <x-primary-button type="button" onclick="window.location.href='{{ route('courses.edit', $course->id) }}'">Edit</x-primary-button>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit">Delete</x-danger-button>
                        </form>
                        @endif
                        <form action="{{ route('courses.enroll', $course) }}" method="POST">
                            @csrf
                            <x-secondary-button type="submit">Enroll</x-secondary-button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
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
