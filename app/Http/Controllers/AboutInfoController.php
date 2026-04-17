<?php

namespace App\Http\Controllers;

use App\Models\AboutInfo;
use Illuminate\Http\Request;

class AboutInfoController extends Controller
{
   // Afficher le formulaire d'édition (Read)
    public function edit()
    {
        $info = AboutInfo::getInfo();
        return view('admin.aboutInfos.edit', compact('info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $info = AboutInfo::getInfo();
        $validated = $request->validate([
        'job_title' => 'nullable|string',
        'intro_text' => 'nullable|string',
        'intro_title' => 'nullable|string',
        'expertise_text' => 'nullable|string',
        'performance_text' => 'nullable|string',
        'parcour_text' => 'nullable|string',
        'service_text' => 'nullable|string',
        'temoin_text' => 'nullable|string',
        'contact_text' => 'nullable|string',
        'competence_text' => 'nullable|string',
        'profile_text' => 'nullable|string',
        'realisation_text' => 'nullable|string',
    ]);
            // Nettoyage HTML sécurisé (autorise seulement certaines balises)
        $validated['intro_text'] = $this->sanitizeHtml($request->intro_text);
        $validated['intro_title'] = $this->sanitizeHtml($request->intro_title);
        $validated['expertise_text'] = $this->sanitizeHtml($request->expertise_text);
        $validated['performance_text'] = $this->sanitizeHtml($request->performance_text);
        $validated['parcour_text'] = $this->sanitizeHtml($request->parcour_text);
        $validated['service_text'] = $this->sanitizeHtml($request->service_text);
        $validated['temoin_text'] = $this->sanitizeHtml($request->temoin_text);
        $validated['contact_text'] = $this->sanitizeHtml($request->contact_text);
        $validated['competence_text'] = $this->sanitizeHtml($request->competence_text);
        $validated['profile_text'] = $this->sanitizeHtml($request->profile_text);
        $validated['realisation_text'] = $this->sanitizeHtml($request->realisation_text);

        $info->update($validated);

        return redirect()->route('admin.about.edit')
                         ->with('success', 'Les informations ont été mises à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
     // Supprimer tout (optionnel) – réinitialise avec les valeurs par défaut
    public function reset()
    {
        $info = AboutInfo::getInfo();
        $info->update([
            'job_title' => 'pas d\'information personnalisé veillez mettre à jours vos données',
            'intro_title'=> 'pas d\'information personnalisé veillez mettre à jours vos données',
            'intro_text' => 'pas d\'information personnalisé veillez mettre à jours vos données',
            'expertise_text' => 'pas d\'information personnalisé veillez mettre à jours vos données',
            'performance_text' => 'pas d\'information personnalisé veillez mettre à jours vos données',
            'parcour_text' => 'pas d\'information personnalisé veillez mettre à jours vos données',
            'service_text' => 'pas d\'information personnalisé veillez mettre à jours vos données',
            'temoin_text' => 'pas d\'information personnalisé veillez mettre à jours vos données',
            'contact_text' => 'pas d\'information personnalisé veillez mettre à jours vos données',
            'competence_text' => 'pas d\'information personnalisé veillez mettre à jours vos données',
            'profile_text' => 'pas d\'information personnalisé veillez mettre à jours vos données',
            'realisation_text' => 'pas d\'information personnalisé veillez mettre à jours vos données',
        ]);
        return redirect()->route('admin.about.edit')
                         ->with('success', 'Réinitialisation effectuée.');
    }

        // Fonction de nettoyage HTML (autorise gras, italique, listes, liens, etc.)
    private function sanitizeHtml($html)
    {
        if (empty($html)) return null;
        // Autoriser les balises suivantes
        $allowedTags = '<strong><b><em><i><u><ul><ol><li><p><br><a><span><div><h1><h2><h3><h4><h5><h6><img><table><tr><td><th>';
        return strip_tags($html, $allowedTags);
    }
}
