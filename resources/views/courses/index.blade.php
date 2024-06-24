<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
                <a href="{{ route('courses.create') }}" class="btn btn-light mb-4">Create Course</a>
                @endif
                @if ($message = Session::get('success'))
                    <div class="alert alert-success mt-3">
                        {{ $message }}
                    </div>
                @endif

                @if ($courses->isEmpty())
                    <p>There are no courses to display.</p>
                @else
                <div class="row">  <form method="GET" action="{{ route('courses.index') }}">
                    <div class="flex items-center">
                        <input type="text" name="search" placeholder="Search courses..." class="form-input rounded-md shadow-sm mt-1 block w-full">
                        <button type="submit" class="ml-2 btn btn-primary">Search</button>
                    </div>
                </form>
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
            @endif</div>
                    <div class="row">
                        @foreach ($courses as $course)
                            <div class="col-md-4 mb-4">
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
                                            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info btn-sm">View</a>
                                            @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
                                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                            @endif
                                            <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Enroll in this course</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
