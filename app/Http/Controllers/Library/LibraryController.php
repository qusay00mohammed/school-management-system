<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Models\Stage;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        $books = Library::all();
        return view('pages.library.index', compact('books'));
    }

    public function create()
    {
        $stage = Stage::all();
        return view('pages.library.add', compact('stage'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => "required|mimetypes:application/pdf",
            'title' => "required",
            'section_id' => "required",
            // 'teacher_id' => "required",
        ]);

        try {
            $book = new Library();
            $book->title = $request->title;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;

            // upload file
            $file = $request->file('file');
            $fileName = time() . $file->getClientOriginalName();
            $file->storeAs('attachments/library', $fileName, ['disk' => 'public']);
            $book->file_name = $fileName;

            $book->save();

            return redirect()->route('library.index')->with('success', __('trans_notification.saved'));
        } catch (\Exception $e) {
            return redirect()->route('library.index')->with(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        return response()->download(public_path('storage/attachments/library/' . $id));
    }

    public function edit($id)
    {
        $stage = Stage::all();
        $book = library::findOrFail($id);
        return view('pages.library.edit', compact('book','stage'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => "required",
            'section_id' => "required",
            // 'teacher_id' => "required",
        ]);

        try {
            $book = Library::findOrFail($id);
            $book->title = $request->title;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;

            if($request->hasFile('file'))
            {
                $request->validate([
                    'file' => "required|mimetypes:application/pdf",
                ]);

                unlink('storage/attachments/library/'. $book->file_name);
                // upload file
                $file = $request->file('file');
                $fileName = time() . $file->getClientOriginalName();
                $file->storeAs('attachments/'. 'library', $fileName, 'public');
                $book->file_name = $fileName;
            }

            $book->save();
            return redirect()->route('library.index')->with('success', __('trans_notification.edited'));
        } catch (\Exception $e) {
            return redirect()->route('library.index')->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $book = Library::findOrFail($id);
        $book->delete();
        unlink('storage/attachments/library/'. $book->file_name);
        return redirect()->route('library.index')->with('warning', __('trans_notification.deleted'));
    }
}
