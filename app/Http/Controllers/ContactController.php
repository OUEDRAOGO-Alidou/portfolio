<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
       public function index(){
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

        public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'message'   => 'nullable|string',
        ]);

        // Création de l'enregistrement
        Contact::create($validated);

        // Redirection avec message de succès
        return  redirect(route('portfolio'))->with('success', 'Message envoyé avec succès !');

    }
}
