<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Quiz for {{ $course->title }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('courses.quizzes.store', ['course' => $course->id]) }}">
                            @csrf

                            <div class="form-group">
                                <label for="title">Quiz Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="form-group" id="questions">
                                <label for="question">Questions</label>
                                <div class="question mb-3">
                                    <input type="text" class="form-control" name="questions[0][question]" placeholder="Enter question" required>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="questions[0][correct_answer]" value="0" required>
                                        <input type="text" class="form-control ml-2" name="questions[0][options][]" placeholder="Answer 1" required>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="questions[0][correct_answer]" value="1" required>
                                        <input type="text" class="form-control ml-2" name="questions[0][options][]" placeholder="Answer 2" required>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="questions[0][correct_answer]" value="2" required>
                                        <input type="text" class="form-control ml-2" name="questions[0][options][]" placeholder="Answer 3" required>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="questions[0][correct_answer]" value="3" required>
                                        <input type="text" class="form-control ml-2" name="questions[0][options][]" placeholder="Answer 4" required>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary" id="add-question">Add Question</button>
                            <button type="submit" class="btn btn-primary">Create Quiz</button>
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
                <div class="question mb-3">
                    <input type="text" class="form-control" name="questions[` + questionIndex + `][question]" placeholder="Enter question" required>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="questions[` + questionIndex + `][correct_answer]" value="0" required>
                        <input type="text" class="form-control ml-2" name="questions[` + questionIndex + `][options][]" placeholder="Answer 1" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="questions[` + questionIndex + `][correct_answer]" value="1" required>
                        <input type="text" class="form-control ml-2" name="questions[` + questionIndex + `][options][]" placeholder="Answer 2" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="questions[` + questionIndex + `][correct_answer]" value="2" required>
                        <input type="text" class="form-control ml-2" name="questions[` + questionIndex + `][options][]" placeholder="Answer 3" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="questions[` + questionIndex + `][correct_answer]" value="3" required>
                        <input type="text" class="form-control ml-2" name="questions[` + questionIndex + `][options][]" placeholder="Answer 4" required>
                    </div>
                </div>`;
            document.getElementById('questions').insertAdjacentHTML('beforeend', questionTemplate);
        });
    </script>
</x-app-layout>
