<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
        protected $fillable = [
        'title',
        'description',
        'image',
        'lien',
        'categorie',
        'categorie_slug',
        'technologies',
        'chiffre_cle',
        'ordre',
        'is_active'
        ];

        protected $casts = [
        'technologies' => 'array',
        'is_active' => 'boolean',
    ];

     // Auto-générer le slug de catégorie
    protected static function booted()
    {
        static::saving(function ($project) {
            $project->categorie_slug = strtolower(str_replace(' ', '-', $project->categorie));
        });
    }
}
