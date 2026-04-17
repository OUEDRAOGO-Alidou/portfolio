<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'position'  => 'required|string|max:255',
            'message'   => 'required|string',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order'     => 'nullable|integer|min:0',
            'is_active' => 'sometimes|boolean',
        ]);

      if ($request->hasFile('image')) {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        // Nom unique absolu
        $filename = uniqid() . '_' . time() . '.' . $extension;
        $destination = public_path('uploads/testimonials');
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }
        // S'assurer que le fichier n'existe pas déjà
        $counter = 1;
        $originalFilename = $filename;
        while (file_exists($destination . DIRECTORY_SEPARATOR . $filename)) {
            $filename = pathinfo($originalFilename, PATHINFO_FILENAME) . '_' . $counter . '.' . $extension;
            $counter++;
        }
        $file->move($destination, $filename);
        $validated['image'] = 'uploads/testimonials/' . $filename;
    }

        $validated['is_active'] = $request->boolean('is_active', false);
        Testimonial::create($validated);

        return redirect()->route('testimonials.index')
                         ->with('success', 'Témoignage ajouté avec succès.');
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
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
            $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'position'  => 'required|string|max:255',
            'message'   => 'required|string',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order'     => 'nullable|integer|min:0',
            'is_active' => 'sometimes|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($testimonial->image && file_exists(public_path($testimonial->image))) {
                unlink(public_path($testimonial->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/testimonials'), $filename);
            $validated['image'] = 'uploads/testimonials/' . $filename;
        }

        $validated['is_active'] = $request->boolean('is_active', false);
        $testimonial->update($validated);

        return redirect()->route('testimonials.index')
                         ->with('success', 'Témoignage mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
               // Supprimer l'image associée
        if ($testimonial->image && file_exists(public_path($testimonial->image))) {
            unlink(public_path($testimonial->image));
        }
        $testimonial->delete();
        return redirect()->route('testimonials.index')
                         ->with('success', 'Témoignage supprimé.');
    }
}
