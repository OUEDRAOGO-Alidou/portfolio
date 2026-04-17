<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
        public function index()
    {
        $projects = Project::orderBy('ordre')->orderByDesc('id')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'categorie'   => 'required|string|max:255',
            'lien'        => 'nullable|url',
            'chiffre_cle' => 'nullable|string|max:100',
            'technologies'=> 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ordre'       => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        $data = $request->except('image', 'technologies');
        $data['technologies'] = $request->technologies ? array_map('trim', explode(',', $request->technologies)) : [];
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        Project::create($data);

        return redirect()->route('projects.index')->with('success', 'Projet créé avec succès.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.create', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'categorie'   => 'required|string|max:255',
            'lien'        => 'nullable|url',
            'chiffre_cle' => 'nullable|string|max:100',
            'technologies'=> 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ordre'       => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        $data = $request->except('image', 'technologies');
        $data['technologies'] = $request->technologies ? array_map('trim', explode(',', $request->technologies)) : [];

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            $this->deleteImage($project->image);
            $data['image'] = $this->uploadImage($request->file('image'));
        }

        $project->update($data);

        return redirect()->route('projects.index')->with('success', 'Projet mis à jour.');
    }

    public function destroy(Project $project)
    {
        $this->deleteImage($project->image);
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Projet supprimé.');
    }

    public function show(Project $project)
    {
        return view('portfolio.projects.show', compact('project'));
    }

    // ========== Méthodes privées pour l'upload et la suppression ==========

    /**
     * Uploader une image et retourner son chemin relatif.
     */
    private function uploadImage($file)
    {
        // Nettoyer le nom du fichier
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $cleanName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalName);
        $filename = uniqid() . '_' . $cleanName . '.' . $extension;

        $destination = public_path('uploads/projects');
        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $file->move($destination, $filename);

        return 'uploads/projects/' . $filename;
    }

    /**
     * Supprimer une image du serveur.
     */
    private function deleteImage($path)
    {
        if ($path && file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
