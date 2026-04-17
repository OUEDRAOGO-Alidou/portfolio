<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = ['name', 'phone','email', 'city','dateNaiss','age','diplome','site','freelance'];
    protected $casts = [
        'dateNaiss' => 'date',
    ];
}
