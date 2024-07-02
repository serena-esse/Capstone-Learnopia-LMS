{{-- resources/views/lessons/create.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Lesson for {{ $course->title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('courses.lessons.store', $course) }}" method="POST">
            @csrf
            <div>
                <label for="video_url">Video URL</label>
                <input type="url" name="video_url" id="video_url">
            </div>
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div>
                <label for="content">Content</label>
                <textarea name="content" id="content" required></textarea>
            </div>
            <button type="submit">Save Lesson</button>
        </form>
    </div>
@endsection
