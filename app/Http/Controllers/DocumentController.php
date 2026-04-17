<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
   public function index()
    {
        $documents = Document::orderBy('order')->get();
        return view('portfolio.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|string|max:255',
        'file' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5 Mo max
    ]);

    $file = $request->file('file');
    $originalName = $file->getClientOriginalName();
    $path = $file->store('cv', 'public'); // stocke dans storage/app/public/cv

    Document::create([
        'title' => $request->title,
        'file_path' => $path,
        'file_name' => $originalName,
        'mime_type' => $file->getMimeType(),
        'size' => round($file->getSize() / 1024, 2), // Ko
        'order' => $request->order ?? 0,
        'is_active' => $request->has('is_active'),
    ]);

    return redirect()->route('images.index')->with('success', 'Document ajouté.');
    }

    public function download(Document $document)
    {
        // Vérifier que le fichier existe
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404);
        }

        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }

    public function publicDownload(Document $document)
    {
        if (!$document->is_active) {
            abort(404);
        }
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404);
        }
        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Document $document)
    {
        Storage::disk('public')->delete($document->file_path);
        $document->delete();
        return redirect()->route('images.index')->with('success', 'Document supprimé.');
    }
}
