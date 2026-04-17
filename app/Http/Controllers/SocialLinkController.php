<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
     public function index()
    {
        $links = SocialLink::all();
        return view('admin.socials.index', compact('links'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'platforms' => 'required|array',
            'platforms.*' => 'required|string|max:50',
            'urls' => 'required|array',
            'urls.*' => 'required|url|max:255',
        ]);

        // Supprimer tous les anciens liens (remplacement complet)
        SocialLink::truncate(); // ou SocialLink::query()->delete()

        foreach ($request->platforms as $index => $platform) {
            if (!empty($request->urls[$index])) {
                SocialLink::create([
                    'platform' => $platform,
                    'url' => $request->urls[$index],
                ]);
            }
        }

        return redirect()->route('social.index')->with('success', 'Liens enregistrés.');
    }
}
