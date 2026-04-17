<?php

namespace App\Http\Controllers;

use App\Models\Stat;
use Illuminate\Http\Request;

class StatController extends Controller
{
     public function index()
    {
        $stats = Stat::orderBy('order')->get();
        return view('admin.stats.index', compact('stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'icon'  => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'value' => 'required|integer',
            'link'  => 'nullable|url',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        Stat::create($validated);
        return redirect()->route('stats.index')->with('success', 'Statistique ajoutée.');
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
    public function edit(Stat $stat)
    {
        return view('admin.stats.edit', compact('stat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stat $stat)
    {
            $validated = $request->validate([
            'icon'  => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'value' => 'required|integer',
            'link'  => 'nullable|url',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $stat->update($validated);
        return redirect()->route('stats.index')->with('success', 'Statistique mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stat $stat)
    {
        $stat->delete();
        return redirect()->route('stats.index')->with('success', 'Statistique supprimée.');
    }
}
