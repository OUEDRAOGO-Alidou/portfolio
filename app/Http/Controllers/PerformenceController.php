<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class PerformenceController extends Controller
{
        public function project()
    {
        $performences=Project::all();


        return view('portfolio.performences.projet', compact('performences'));
    }
}
