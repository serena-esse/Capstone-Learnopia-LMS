<!-- resources/views/quizzes/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $quiz->title }}
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
                <form method="POST" action="{{ route('courses.quizzes.submit', ['course' => $course->id, 'quiz' => $quiz->id]) }}">
                    @csrf
                    @foreach ($quiz->questions as $index => $question)
                        <div class="form-group">
                            <label>{{ $question->question }}</label>
                            @php
                                $options = json_decode($question->options);
                            @endphp
                            @foreach ($options as $optionIndex => $option)
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="answers[{{ $index }}]" value="{{ $optionIndex }}" id="question_{{ $index }}_option_{{ $optionIndex }}" required>
                                    <label class="form-check-label" for="question_{{ $index }}_option_{{ $optionIndex }}">
                                        {{ $option }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary">Submit Answers</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
