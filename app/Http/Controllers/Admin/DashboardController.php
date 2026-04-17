<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;

class DashboardController extends Controller
{
       public function index()
    {
        // 📊 Statistiques principales
        $projectsCount = Project::count();
        $servicesCount = Service::count();
        $testimonialsCount = Testimonial::count();
        $messagesCount = Contact::count();

        // 📌 Derniers éléments
        $latestProjects = Project::latest()->take(5)->get();
        $latestMessages = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'projectsCount',
            'servicesCount',
            'testimonialsCount',
            'messagesCount',
            'latestProjects',
            'latestMessages'
        ));
    }

    public function portfolio(){

        $projectsCount = Project::count();
        $servicesCount = Service::count();
        $testimonialsCount = Testimonial::count();
        $messagesCount = Contact::count();

        // 📌 Derniers éléments
        $latestProjects = Project::latest()->take(5)->get();
        $latestMessages = Contact::latest()->take(5)->get();

      return view('portfolio.index', compact(
            'projectsCount',
            'servicesCount',
            'testimonialsCount',
            'messagesCount',
            'latestProjects',
            'latestMessages'
        ));
    }
}
