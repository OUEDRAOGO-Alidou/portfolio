<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
     public function index()
    {
        $information = Information::first();
        return view('admin.informations.index', compact('information'));
    }

    /**
     * Show form to edit profile
     */
    public function edit(Information $information)
    {
        return view('admin.informations.edit', compact('information'));
    }

    /**
     * Store (si aucun profil n'existe)
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $information = Information::first();
        if ($information) {
            // Mettre à jour l'existant
            $information->update($data);
            return redirect()->route('information.edit', $information->id)
                ->with('success', 'Information mise à jour');
        }

        // Sinon, créer
        $information = Information::create($data);
        return redirect()->route('information.edit', $information->id)
            ->with('success', 'Information créée');
        }

    /**
     * Update profile
     */
    public function update(Request $request)
    {
        $information = Information::first();

        $data = $this->validateData($request);

        if (!$information) {
            Information::create($data);
        } else {
            $information->update($data);
        }

        return back()->with('success', 'Information mis à jour avec succès');
    }

    /**
     * Delete profile (optionnel)
     */
    public function destroy()
    {
        $information = Information::first();

        if ($information) {
            $information->delete();
        }

        return back()->with('success', 'Information supprimé');
    }

    /**
     * Validation centralisée
     */
    private function validateData(Request $request)
    {
        return $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:100',
            'dateNaiss' => 'nullable|date',
            'age' => 'nullable|integer',
            'diplome' => 'nullable|string|max:100',
            'site' => 'string|max:255',
            'freelance' => 'nullable|string|max:100',
        ]);
    }
}
