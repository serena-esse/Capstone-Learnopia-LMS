<?php
// app/Http/Controllers/FileController.php
// app/Http/Controllers/FileController.php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function showUploadForm($courseId, $lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        return view('files.upload', compact('lesson'));
    }

    public function upload(Request $request, $courseId, $lessonId)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048'
        ]);

        $lesson = Lesson::findOrFail($lessonId);

        $file = $request->file('file');
        $filename = time().'_'.$file->getClientOriginalName();
        $filepath = $file->storeAs('uploads', $filename, 'public');

        $fileModel = new File;
        $fileModel->filename = $filename;
        $fileModel->filepath = $filepath; // Memorizza solo il percorso relativo
        $fileModel->user_id = Auth::id();
        $fileModel->lesson_id = $lesson->id;
        $fileModel->save();

        return back()
            ->with('success', 'File has been uploaded.')
            ->with('file', $filename);
    }

    public function download($courseId, $lessonId, $fileId)
    {
        $file = File::findOrFail($fileId);

        $filepath = storage_path('app/public/' . $file->filepath); // Usa il percorso completo del file

        if (!file_exists($filepath)) {
            abort(404, "File not found");
        }

        return response()->download($filepath, $file->filename);
    }
}
