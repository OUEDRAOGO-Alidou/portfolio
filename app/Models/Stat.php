<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Stat extends Model
{
          protected $fillable = ['icon', 'title','value','link','order','is_active'];

     protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function getActiveStats()
    {
        return Cache::remember('active_stats', 3600, function () {
            return self::where('is_active', true)->orderBy('order')->get();
        });
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('active_stats');
        });
        static::deleted(function () {
            Cache::forget('active_stats');
        });
    }
}
