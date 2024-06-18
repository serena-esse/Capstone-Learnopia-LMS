<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Quiz: {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="overflow-hidden shadow sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('quiz.submit', $quiz) }}" method="POST">
                    @csrf
                    @foreach ($quiz->questions as $question)
                        <div class="mb-4">
                            <p><strong>{{ $question->question_text }}</strong></p>
                            @foreach ($question->answers as $answer)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]" id="answer{{ $answer->id }}" value="{{ $answer->id }}">
                                    <label class="form-check-label" for="answer{{ $answer->id }}">
                                        {{ $answer->answer_text }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Submit Quiz</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
