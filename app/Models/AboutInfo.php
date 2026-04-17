<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AboutInfo extends Model
{
     protected $table = 'about_infos';
    protected $fillable = [
        'job_title',
        'intro_text',
        'expertise_text',
        'intro_title',
        'performance_text',
        'parcour_text',
        'service_text',
        'temoin_text',
        'contact_text',
        'competence_text',
        'profile_text',
        'realisation_text'
        ];


        // Récupère l'unique enregistrement (le premier ou en crée un par défaut)
    public static function getInfo()
    {
        // On utilise une clé différente, et on stocke un tableau au lieu d'un objet
        return Cache::remember('about_info_array', 3600, function () {
            $info = self::first();
            if (!$info) {
                $info = self::create([
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
            }
            // Retourner un tableau, pas un objet
            return $info->toArray();
        });
    }

    // Vide le cache après modification
   protected static function booted()
    {
        static::saved(function () {
            Cache::forget('about_info_array'); // nouvelle clé
        });
    }
}
