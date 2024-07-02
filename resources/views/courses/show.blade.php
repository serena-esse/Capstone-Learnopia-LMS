<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Course Details
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="overflow-hidden shadow sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-4">
                    <h2 class="text-2xl font-semibold">{{ $course->title }}</h2>
                </div>
                @if ($course->image)
                    <div class="mb-4">
                        <img src="{{ asset('images/' . $course->image) }}" alt="{{ $course->title }}" class="rounded-lg">
                    </div>
                @endif

                <div class="mb-4">
                    <p>{{ $course->description }}</p>
                </div>
                <div class="mb-4">
                    <p><strong>Start Date:</strong> {{ $course->start_date }}</p>
                </div>
                <div class="mb-4">
                    <p><strong>End Date:</strong> {{ $course->end_date }}</p>
                </div>
               <x-primary-button> <a href="{{ route('courses.index') }}">Back to Courses</a></x-primary-button> 
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="overflow-hidden shadow sm:rounded-lg">
            <div class="p-6  border-b border-gray-200">
                <h3 class="text-lg font-semibold mb-4">Lessons</h3>
                @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
                <x-primary-button> <a href="{{ route('courses.lessons.create', ['course' => $course->id]) }}" class=" mb-3">Add Lesson</a> </x-primary-button>
            @endif
                @if($course->lessons->isEmpty())
                    <p>No lessons available.</p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($course->lessons as $lesson)
                            <div class="flex flex-col bg-white border border-gray-300 rounded-lg shadow-sm overflow-hidden">
                                <div class="p-4 flex-1">
                                    <a href="{{ route('courses.lessons.show', [$course, $lesson]) }}" class=" font-semibold">{{ $lesson->title }}</a>
                                    <div class="mt-2">
                                        @if ($lesson->video_url)
                                            <div class="video-container">
                                                <iframe src="{{ $lesson->video_url }}" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        @else
                                            <p>No video available</p>
                                        @endif
                                    </div>
                                    <div class="mt-2">
                                        {!! nl2br(e($lesson->content)) !!}
                                    </div>
                                </div>
                                <div class="p-4 bg-gray-100">
                                    @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
                                        <div class="flex justify-end space-x-2">
                                            <x-secondary-button><a href="{{ route('courses.lessons.edit', [$course, $lesson]) }}" class=" btn-sm">Edit</a></x-secondary-button>
                                            <form action="{{ route('courses.lessons.destroy', [$course, $lesson]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button type="submit" class="btn  btn-sm">Delete</x-danger-button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="overflow-hidden shadow sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h3 class="text-lg font-semibold mb-4">Quizzes</h3>
                @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
                    <div class="mb-4">
                        <x-primary-button><a href="{{ route('courses.quizzes.create', $course) }}" class="text-white">Add Quiz</a></x-primary-button>
                    </div>
                @endif
                @if($course->quizzes->isEmpty())
                    <p>No quizzes available.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($course->quizzes as $quiz)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4 flex flex-col justify-between">
                                <div>
                                    <a href="{{ route('courses.quizzes.show', [$course, $quiz]) }}" class="text-lg font-semibold text-blue-500">{{ $quiz->title }}</a>
                                </div>
                                @if (Auth::user()->isAdmin() || Auth::user()->isTeacher())
                                    <div class="flex justify-end mt-4">
                                       <x-secondary-button> <a href="{{ route('courses.quizzes.edit', ['course' => $course->id, 'quiz' => $quiz->id]) }}" class="mr-2  btn-sm ">Edit</a></x-secondary-button>
                                        <form action="{{ route('courses.quizzes.destroy', [$course, $quiz]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit" class="btn btn-sm ">Delete</x-danger-button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    

    <style>
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            max-width: 100%;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</x-app-layout>
