<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
         public function index()
    {
        $documents = Document::orderBy('order')->get();
        $images = Image::all()->keyBy('type'); // ['banner' => objet, 'profile' => ...]
        return view('admin.images.index', compact('images','documents'));
    }

    public function store(Request $request)
    {

       $validated = $request->validate([
        'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'about'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $types = ['banner', 'profile', 'about'];

    foreach ($types as $type) {
        if ($request->hasFile($type)) {
            $file = $request->file($type);
            // Stockage local
            $path = $file->store('portfolio/' . $type, 'public');
            $imageUrl = Storage::url($path);

            Image::updateOrCreate(
                ['type' => $type],
                ['path' => $imageUrl, 'filename' => basename($path)]
            );
        }
    }

    return redirect()->back()->with('success', 'Images mises à jour avec succès.');
 }

}
