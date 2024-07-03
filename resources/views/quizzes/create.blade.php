<x-app-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-black">Create New Quiz for {{ $course->title }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('courses.quizzes.store', ['course' => $course->id]) }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="title">Quiz Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter quiz title" required>
                            </div>

                            <div class="form-group mb-3" id="questions">
                                <label for="question">Questions</label>
                                <div class="question mb-4">
                                    <input type="text" class="form-control mb-2" name="questions[0][question]" placeholder="Enter question" required>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="radio" name="questions[0][correct_answer]" value="0" required>
                                        <input type="text" class="form-control ml-2" name="questions[0][options][]" placeholder="Answer 1" required>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="radio" name="questions[0][correct_answer]" value="1" required>
                                        <input type="text" class="form-control ml-2" name="questions[0][options][]" placeholder="Answer 2" required>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="radio" name="questions[0][correct_answer]" value="2" required>
                                        <input type="text" class="form-control ml-2" name="questions[0][options][]" placeholder="Answer 3" required>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="radio" name="questions[0][correct_answer]" value="3" required>
                                        <input type="text" class="form-control ml-2" name="questions[0][options][]" placeholder="Answer 4" required>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <x-secondary-button type="button" class="btn btn-secondary" id="add-question">Add Question</x-secondary-button>
                                <x-primary-button type="submit" class="btn btn-primary">Create Quiz</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-question').addEventListener('click', function () {
            var questionIndex = document.querySelectorAll('.question').length;
            var questionTemplate = `
                <div class="question mb-4">
                    <input type="text" class="form-control mb-2" name="questions[` + questionIndex + `][question]" placeholder="Enter question" required>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="questions[` + questionIndex + `][correct_answer]" value="0" required>
                        <input type="text" class="form-control ml-2" name="questions[` + questionIndex + `][options][]" placeholder="Answer 1" required>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="questions[` + questionIndex + `][correct_answer]" value="1" required>
                        <input type="text" class="form-control ml-2" name="questions[` + questionIndex + `][options][]" placeholder="Answer 2" required>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="questions[` + questionIndex + `][correct_answer]" value="2" required>
                        <input type="text" class="form-control ml-2" name="questions[` + questionIndex + `][options][]" placeholder="Answer 3" required>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="questions[` + questionIndex + `][correct_answer]" value="3" required>
                        <input type="text" class="form-control ml-2" name="questions[` + questionIndex + `][options][]" placeholder="Answer 4" required>
                    </div>
                </div>`;
            document.getElementById('questions').insertAdjacentHTML('beforeend', questionTemplate);
        });
    </script>
</x-app-layout>
