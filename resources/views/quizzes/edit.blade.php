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

                    <!-- Ciclo per visualizzare e modificare le domande -->
                    @foreach ($quiz->questions as $index => $question)
                        <div class="form-group">
                            <label for="question_{{ $index }}">Question {{ $index + 1 }}</label>
                            <input type="text" class="form-control" id="question_{{ $index }}" name="questions[{{ $index }}][question]" value="{{ old('questions.'.$index.'.question', $question->question) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="options_{{ $index }}">Options</label>
                            @php
                                $options = json_decode($question->options);
                            @endphp
                            @foreach ($options as $optionIndex => $option)
                                <input type="text" class="form-control mb-2" id="options_{{ $index }}_{{ $optionIndex }}" name="questions[{{ $index }}][options][]" value="{{ old('questions.'.$index.'.options.'.$optionIndex, $option) }}" required>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="correct_answer_{{ $index }}">Correct Answer</label>
                            <input type="number" class="form-control" id="correct_answer_{{ $index }}" name="questions[{{ $index }}][correct_answer]" value="{{ old('questions.'.$index.'.correct_answer', $question->correct_answer) }}" required>
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary">Update Quiz</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
