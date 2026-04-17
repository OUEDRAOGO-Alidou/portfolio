<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name', 'percentage','icon','order','is_active'];

     protected $casts = [
        'is_active' => 'boolean',
    ];
}
