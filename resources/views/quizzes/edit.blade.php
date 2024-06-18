<!-- resources/views/courses/quizzes/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Quiz: {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="overflow-hidden shadow sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('courses.quizzes.update', ['course' => $course->id, 'quiz' => $quiz->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Quiz Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $quiz->title) }}" required>
                    </div>

                    <!-- Aggiungi qui i campi per le domande e le risposte del quiz, se necessario -->

                    <button type="submit" class="btn btn-primary">Update Quiz</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
