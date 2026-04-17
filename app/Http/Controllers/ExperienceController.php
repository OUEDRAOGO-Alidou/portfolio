<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
       public function index()
    {
        $experiences = Experience::orderBy('order')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'required|string',
            'order'       => 'nullable|integer|min:0',
        ]);
        Experience::create($validated);
        return redirect()->route('experiences.index')->with('success', 'Expérience ajoutée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
         return view('admin.experiences.edit', compact('experience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
            $validated = $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'required|string',
            'order'       => 'nullable|integer|min:0',
        ]);
        $experience->update($validated);
        return redirect()->route('experiences.index')->with('success', 'Expérience mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('experiences.index')->with('success', 'Expérience supprimée.');
    }
}
