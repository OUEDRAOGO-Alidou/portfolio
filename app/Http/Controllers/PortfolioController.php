<?php


namespace App\Http\Controllers;

use App\Models\AboutInfo;
use App\Models\Contact;
use App\Models\Document;
use App\Models\Experience;
use App\Models\Formation;
use App\Models\Image;
use App\Models\Information;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Stat;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

class PortfolioController extends Controller
{
          public function index()
    {
        // Compteurs (retournent 0 si table vide)
        $projectsCount = Project::count();
        $servicesCount = Service::count();
        $testimonialsCount = Testimonial::count();
        $messagesCount = Contact::count();

        $projects = Project::where('is_active', true)->orderBy('ordre')->get();
        $categories = $projects->pluck('categorie')->unique()->values();
        $latestProjects = Project::latest()->take(5)->get();
        $latestMessages = Contact::latest()->take(5)->get();
        $formations = Formation::orderBy('order')->get();
        $experiences = Experience::orderBy('order')->get();
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $skills = Skill::where('is_active', true)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
        $stats = Stat::where('is_active', true)->orderBy('order')->get();


       $info = AboutInfo::getInfo();

        // Gestion de la table "information" (peut être vide)
        $information = Information::first();
        if (!$information) {
            // Créer un objet Information virtuel avec des valeurs par défaut
            $information = new Information();
            $information->name = 'Ouedraogo Alidou';
            $information->site = 'w.w.w.flashnovatech.com';
            $information->email = 'flashnovatech@gmail.com';
            $information->phone = '+226 67 10 72 10';
            $information->city = 'Ouagadougou, Burkina Faso';
            $information->dateNaiss = '20-08-2025';
            $information->diplome = 'Licence 3 informatique';
            $information->freelance = 'Disponible';
            // Ajoutez d'autres propriétés utilisées dans votre vue
        }

        $images = Image::all()->keyBy('type');

        return view('portfolio.index', compact(
            'projectsCount', 'servicesCount', 'testimonialsCount', 'messagesCount','info',
            'projects', 'testimonials', 'skills', 'images','experiences','stats','categories',
            'latestProjects', 'latestMessages', 'information','services','formations',
        ));
    }
}
