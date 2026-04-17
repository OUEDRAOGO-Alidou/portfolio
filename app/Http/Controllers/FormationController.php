<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = Formation::orderBy('order')->get();
        return view('admin.formations.index', compact('formations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.formations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'diplome'     => 'required|string|max:255',
            'annee'       => 'required|string|max:20',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer|min:0',
        ]);

        Formation::create($validated);
        return redirect()->route('formations.index')->with('success', 'Formation ajoutée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Formation $formation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formation $formation)
    {
        return view('admin.formations.edit', compact('formation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formation $formation)
    {
            $validated = $request->validate([
            'diplome'     => 'required|string|max:255',
            'annee'       => 'required|string|max:20',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer|min:0',
        ]);

        $formation->update($validated);
        return redirect()->route('formations.index')->with('success', 'Formation mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formation $formation)
    {
        $formation->delete();
        return redirect()->route('formations.index')->with('success', 'Formation supprimée.');
    }
}
